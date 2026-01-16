<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProdImgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_images = [
            // Existing product images
            [
                'product_id' => 1,
                'mainImage' => 'storage/images/w9vCuk5HXGGj2lR4syPM-800.webp',
            ],
            [
                'product_id' => 2,
                'mainImage' => 'storage/images/w9vCuk5HXGGj2lR4syPM-800.webp',
            ],
            [
                'product_id' => 3,
                'mainImage' => 'storage/images/w9vCuk5HXGGj2lR4syPM-800.webp',
            ],
            [
                'product_id' => 4,
                'mainImage' => 'storage/images/w9vCuk5HXGGj2lR4syPM-800.webp',
            ],
        ];

        // Add images for products 205-300 (since the actual product IDs start from 201)
        $imageNames = [
            'veil-chiffon-01.webp', 'veil-chiffon-02.webp', 'veil-krepe-01.webp', 'veil-krepe-02.webp',
            'veil-satin-01.webp', 'veil-satin-02.webp', 'veil-silk-01.webp', 'veil-silk-02.webp',
            'veil-cotton-01.webp', 'veil-cotton-02.webp', 'embroidered-veil-01.webp', 'embroidered-veil-02.webp',
            'luxury-veil-01.webp', 'luxury-veil-02.webp', 'premium-veil-01.webp', 'premium-veil-02.webp',
            'elegant-veil-01.webp', 'elegant-veil-02.webp', 'classic-veil-01.webp', 'classic-veil-02.webp'
        ];

        // Update existing product images to use correct IDs
        // Note: DB::table('products')->insert($products) doesn't guarantee IDs if not specified,
        // but typically starts at 1 if table is empty.

        $product_images[0]['product_id'] = 1;
        $product_images[1]['product_id'] = 2;
        $product_images[2]['product_id'] = 3;
        $product_images[3]['product_id'] = 4;

        for ($i = 5; $i <= 100; $i++) {
            $randomImage = $imageNames[array_rand($imageNames)];
            $product_images[] = [
                'product_id' => $i,
                'mainImage' => 'storage/images/' . $randomImage,
            ];
        }

        DB::table('prodimgs')->insert($product_images);
     }
}
