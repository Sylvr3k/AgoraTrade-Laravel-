<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained('listings')->onDelete('cascade');
            $table->foreignId('buyer_id')->constrained('createusers')->onDelete('cascade');
            $table->foreignId('seller_id')->constrained('createusers')->onDelete('cascade');
            $table->string('item_name');         // snapshot of listing title at time of purchase
            $table->decimal('price', 10, 2);     // snapshot of price at time of purchase
            $table->string('buyer_name');         // snapshot of buyer name
            $table->string('buyer_email');        // snapshot of buyer email
            $table->string('buyer_address')->nullable(); // shipping address
            $table->enum('status', ['Pending', 'Shipped', 'Delivered', 'Cancelled'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};