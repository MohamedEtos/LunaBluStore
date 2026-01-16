<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = [
            ['name' => 'طرح',],
            ['name' => 'عباءة',],
            ['name' => 'ملابس نسائية',],
            ['name' => 'إكسسوارات',],
            ['name' => 'ملابس رجالية',],
        ];

        DB::table('categories')->insert($category);    }
}
