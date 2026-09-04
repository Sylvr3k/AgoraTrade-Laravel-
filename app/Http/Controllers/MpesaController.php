<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Listing;
use App\Models\Order;
use App\Models\PendingOrder;

class MpesaController extends Controller
{
    private function getAccessToken()
    {
        $consumerKey    = env('MPESA_CONSUMER_KEY');
        $consumerSecret = env('MPESA_CONSUMER_SECRET');
        $credentials    = base64_encode($consumerKey . ':' . $consumerSecret);

        $url = env('MPESA_ENV') === 'production'
            ? 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
            : 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic ' . $credentials]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response);
        return $result->access_token ?? null;
    }

    public function stkPush(Request $request)
    {
        $request->validate([
            'listing_id'    => 'required|exists:listings,id',
            'phone'         => 'required|string',
            'buyer_name'    => 'required|string',
            'buyer_email'   => 'required|email',
            'buyer_address' => 'required|string',
        ]);

        $listing = Listing::findOrFail($request->listing_id);

        // Prevent buying your own listing
        if ($listing->user_id === Auth::id()) {
            return response()->json(['success' => false, 'message' => 'You cannot buy your own listing.']);
        }

        // Format phone number — convert 07XX to 2547XX
        $phone = preg_replace('/\D/', '', $request->phone);
        if (substr($phone, 0, 1) === '0') {
            $phone = '254' . substr($phone, 1);
        }
        if (substr($phone, 0, 3) !== '254') {
            $phone = '254' . $phone;
        }

        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return response()->json(['success' => false, 'message' => 'Failed to get M-Pesa access token.']);
        }

        $shortcode  = env('MPESA_SHORTCODE');
        $passkey    = env('MPESA_PASSKEY');
        $timestamp  = date('YmdHis');
        $password   = base64_encode($shortcode . $passkey . $timestamp);
        $amount     = (int) ceil($listing->price);
        $callbackUrl = env('MPESA_CALLBACK_URL');

        $url = env('MPESA_ENV') === 'production'
            ? 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest'
            : 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $payload = [
            'BusinessShortCode' => $shortcode,
            'Password'          => $password,
            'Timestamp'         => $timestamp,
            'TransactionType'   => 'CustomerPayBillOnline',
            'Amount'            => $amount,
            'PartyA'            => $phone,
            'PartyB'            => $shortcode,
            'PhoneNumber'       => $phone,
            'CallBackURL'       => $callbackUrl,
            'AccountReference'  => 'AgoraTrade',
            'TransactionDesc'   => 'Payment for ' . $listing->title,
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response);

        Log::info('M-Pesa STK Push Response: ' . $response);

        if (isset($result->ResponseCode) && $result->ResponseCode === '0') {
            // Store pending order in database instead of session
            PendingOrder::create([
                'checkout_request_id' => $result->CheckoutRequestID,
                'listing_id'          => $listing->id,
                'buyer_id'            => Auth::id(),
                'seller_id'           => $listing->user_id,
                'item_name'           => $listing->title,
                'price'               => $listing->price,
                'buyer_name'          => $request->buyer_name,
                'buyer_email'         => $request->buyer_email,
                'buyer_address'       => $request->buyer_address,
            ]);

            return response()->json([
                'success'           => true,
                'message'           => 'STK Push sent! Check your phone and enter your M-Pesa PIN.',
                'CheckoutRequestID' => $result->CheckoutRequestID,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result->errorMessage ?? 'STK Push failed. Please try again.',
        ]);
    }

    public function callback(Request $request)
    {
        $data = $request->all();
        Log::info('M-Pesa Callback: ' . json_encode($data));

        $body = $data['Body']['stkCallback'] ?? null;

        if (!$body) {
            return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Accepted']);
        }

        $resultCode        = $body['ResultCode'];
        $checkoutRequestId = $body['CheckoutRequestID'];

        if ($resultCode === 0) {
            // Find the pending order using CheckoutRequestID
            $pending = PendingOrder::where('checkout_request_id', $checkoutRequestId)->first();

            if ($pending) {
                // Create the real order
                Order::create([
                    'listing_id'    => $pending->listing_id,
                    'buyer_id'      => $pending->buyer_id,
                    'seller_id'     => $pending->seller_id,
                    'item_name'     => $pending->item_name,
                    'price'         => $pending->price,
                    'buyer_name'    => $pending->buyer_name,
                    'buyer_email'   => $pending->buyer_email,
                    'buyer_address' => $pending->buyer_address,
                    'status'        => 'Pending',
                ]);

                // Mark listing as sold
                Listing::where('id', $pending->listing_id)->update(['status' => 'sold']);

                // Delete the pending order
                $pending->delete();

                Log::info('Order created successfully after M-Pesa payment.');
            }
        } else {
            Log::warning('M-Pesa payment failed. ResultCode: ' . $resultCode);
        }

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Accepted']);
    }
}