<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $table = 'listings';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'price',
        'condition',
        'location',
        'image',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(NewUser::class, 'user_id');
    }
}