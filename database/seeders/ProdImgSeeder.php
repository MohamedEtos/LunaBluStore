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
                ]
            ];





        DB::table('prodimgs')->insert($product_images);
     }
}
