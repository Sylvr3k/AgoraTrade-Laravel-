<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'listing_id',
        'buyer_id',
        'seller_id',
        'item_name',
        'price',
        'status',
        'buyer_name',
        'buyer_email',
        'buyer_address',
    ];

    // The listing that was purchased
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    // The buyer
    public function buyer()
    {
        return $this->belongsTo(NewUser::class, 'buyer_id');
    }

    // The seller
    public function seller()
    {
        return $this->belongsTo(NewUser::class, 'seller_id');
    }
}