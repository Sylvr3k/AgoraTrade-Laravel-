<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingOrder extends Model
{
    protected $table = 'pending_orders';

    protected $fillable = [
        'checkout_request_id',
        'listing_id',
        'buyer_id',
        'seller_id',
        'item_name',
        'price',
        'buyer_name',
        'buyer_email',
        'buyer_address',
    ];
}
