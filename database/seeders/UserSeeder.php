<?php

namespace Database\Seeders;

use App\Models\NewUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        NewUser::updateOrCreate(
            ['email' => 'seller@test.com'],
            [
                'fullname' => 'Test Seller',
                'username' => 'testseller',
                'password' => Hash::make('password'),
            ]
        );

        NewUser::updateOrCreate(
            ['email' => 'buyer@test.com'],
            [
                'fullname' => 'Test Buyer',
                'username' => 'testbuyer',
                'password' => Hash::make('password'),
            ]
        );
    }
}
