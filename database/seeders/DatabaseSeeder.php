<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::table('categories')->insert([
            [
                'category_name' => 'Drinks',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Desserts',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Main Course',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('products')->insert([
            [
                'product_category' => 1,
                'product_img' => 'product1.jpg',
                'product_price' => 19.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_category' => 2,
                'product_img' => 'product2.jpg',
                'product_price' => 29.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_category' => 1,
                'product_img' => 'product3.jpg',
                'product_price' => 9.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('product_names')->insert([
            [
                'product_id' => 1,
                'locale' => 'en',
                'product_name' => 'Apple Juice',
                'product_description' => 'Freshly squeezed apple juice.',
                'product_allergens' => 'None',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'locale' => 'lv',
                'product_name' => 'Ābolu sula',
                'product_description' => 'Svaigi spiesta ābolu sula.',
                'product_allergens' => 'Nav',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'locale' => 'en',
                'product_name' => 'Orange Smoothie',
                'product_description' => 'Smooth and creamy orange smoothie.',
                'product_allergens' => 'Dairy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'locale' => 'lv',
                'product_name' => 'Apelsīnu smūtijs',
                'product_description' => 'Maigs un krēmīgs apelsīnu smūtijs.',
                'product_allergens' => 'Piena produkti',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('users')->insert([
            [
                'id' => 1,
                'email' => "ish@email.com",
                'password' => "easports",
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('tables')->insert([
            ['table_number' => 1],
            ['table_number' => 2],
            ['table_number' => 3],
            ['table_number' => 4],
            ['table_number' => 5],
        ]);
    }
}
