<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\NewUser;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    public function run(): void
    {
        $seller = NewUser::where('email', 'seller@test.com')->first();

        if (!$seller) {
            return;
        }

        $listings = [
            [
                'title'       => 'Wireless Mouse - Ergonomic',
                'description' => 'Comfortable wireless mouse, barely used. Great battery life.',
                'category'    => 'Computers/Tablets & Networking',
                'price'       => 1500.00,
                'condition'   => 'Like New',
                'location'    => 'Nairobi',
            ],
            [
                'title'       => 'Classic Denim Jacket - Medium',
                'description' => 'Stylish denim jacket, worn a handful of times, no flaws.',
                'category'    => 'Clothing',
                'price'       => 2500.00,
                'condition'   => 'Like New',
                'location'    => 'Nairobi',
            ],
            [
                'title'       => 'PS4 DualShock 4 Controller',
                'description' => 'Original Sony controller, works perfectly, minor wear.',
                'category'    => 'Video Games & Consoles',
                'price'       => 3000.00,
                'condition'   => 'Good',
                'location'    => 'Mombasa',
            ],
            [
                'title'       => 'Novel Collection - 5 Books Bundle',
                'description' => 'Bundle of 5 bestselling novels, good condition.',
                'category'    => 'Books',
                'price'       => 800.00,
                'condition'   => 'Very Good',
                'location'    => 'Kisumu',
            ],
            [
                'title'       => 'Silver Plated Necklace',
                'description' => 'Elegant silver plated necklace, brand new, never worn.',
                'category'    => 'Jewelry & Watches',
                'price'       => 4500.00,
                'condition'   => 'Brand New',
                'location'    => 'Nairobi',
            ],
        ];

        foreach ($listings as $listing) {
            Listing::updateOrCreate(
                ['user_id' => $seller->id, 'title' => $listing['title']],
                array_merge($listing, ['status' => 'active'])
            );
        }
    }
}
