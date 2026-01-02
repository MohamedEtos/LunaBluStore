<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
            'name' => 'طرحه شيفون فاخره مطرزه يدوي',
            'slug' => 'luxury-embroidered-chiffon-veil',
            'cat_id' => 1,
            'fabric_id' => 1,
            'width' => 75,
            'height' => 180,
            'price' => 150,
            'append' => 1,
            'meta_title' => 'طرحه شيفون فاخره مطرزه يدوي',
            'meta_description' => 'طرحه شيفون فاخره مطرزه يدوي',
            'productDetalis' => 'طرحه شيفون فاخره مطرزه يدوي',
            'stock' => 10,
            ],
                       [
            'name' => 'طرحه كريب فاخره مطرزه يدوي',
            'slug' => 'luxury-embroidered-kreb-veil',
            'cat_id' => 1,
            'fabric_id' => 1,
            'width' => 75,
            'height' => 180,
            'price' => 200,
            'append' => 1,
            'meta_title' => 'طرحه كريب فاخره مطرزه يدوي',
            'meta_description' => 'طرحه كريب فاخره مطرزه يدوي',
            'productDetalis' => 'طرحه كريب فاخره مطرزه يدوي',
            'stock' => 10,
            ],
                       [
            'name' => 'طرحه كريب فاخره مطرزه يدوي',
            'slug' => 'luxury-embroidered-kreb2-veil',
            'cat_id' => 1,
            'fabric_id' => 1,
            'width' => 75,
            'height' => 180,
            'price' => 200,
            'append' => 1,
            'meta_title' => 'طرحه كريب فاخره مطرزه يدوي',
            'meta_description' => 'طرحه كريب فاخره مطرزه يدوي',
            'productDetalis' => 'طرحه كريب فاخره مطرزه يدوي',
            'stock' => 10,
            ],
                       [
            'name' => 'طرحه كريب فاخره مطرزه يدوي',
            'slug' => 'luxury-embroidered-kreb3-veil',
            'cat_id' => 1,
            'fabric_id' => 1,
            'width' => 75,
            'height' => 180,
            'price' => 200,
            'append' => 1,
            'meta_title' => 'طرحه كريب فاخره مطرزه يدوي',
            'meta_description' => 'طرحه كريب فاخره مطرزه يدوي',
            'productDetalis' => 'طرحه كريب فاخره مطرزه يدوي',
            'stock' => 10,
            ],

        ];





        DB::table('products')->insert($products);
     }
}
