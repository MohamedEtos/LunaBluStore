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
            // Existing products
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

        // Add 96 more products to make total 100
        $additionalProducts = [];
        $fabrics = ['شيفون', 'كريب', 'ساتان', 'حرير', 'قطن', 'شيفون مطرز', 'كريب مطرز', 'ساتان مطرز'];
        $categories = [1, 2, 3, 4, 5];
        $widths = [60, 70, 75, 80, 85, 90, 100];
        $heights = [160, 170, 175, 180, 185, 190, 200];
        $prices = [50, 75, 100, 125, 150, 175, 200, 250, 300, 350, 400, 450, 500];

        for ($i = 5; $i <= 100; $i++) {
            $fabric = $fabrics[array_rand($fabrics)];
            $category = 1; // Use only category 1 (طرح) as it's available
            $width = $widths[array_rand($widths)];
            $height = $heights[array_rand($heights)];
            $price = $prices[array_rand($prices)];
            $stock = rand(5, 50);

            $productName = "طرحه {$fabric} فاخرة " . ($i % 3 == 0 ? 'مطرزة يدوياً' : 'عالية الجودة');
            $slug = "luxury-{$fabric}-veil-" . $i;

            $additionalProducts[] = [
                'name' => $productName,
                'slug' => $slug,
                'cat_id' => $category,
                'fabric_id' => rand(1, 3),
                'width' => $width,
                'height' => $height,
                'price' => $price,
                'append' => 1,
                'meta_title' => $productName,
                'meta_description' => $productName . ' - منتج عالي الجودة من LunaBlu Store',
                'productDetalis' => $productName . ' - مصنوعة من أفضل المواد ومصممة بعناية فائقة',
                'stock' => $stock,
            ];
        }

        $products = array_merge($products, $additionalProducts);





        DB::table('products')->insert($products);
     }
}
