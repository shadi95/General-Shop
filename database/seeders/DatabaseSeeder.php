<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Address::factory(100)->create();
        User::factory(100)->create();
        Product::factory(100)->create();
        Image::factory(100)->create();    

    }
}
