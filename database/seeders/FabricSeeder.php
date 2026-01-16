<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FabricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fabrics = [
            ['name' => 'شيفون'],
            ['name' => 'كريب'],
            ['name' => 'ساتان'],
            ['name' => 'حرير'],
            ['name' => 'قطن'],
            ['name' => 'شيفون مطرز'],
            ['name' => 'كريب مطرز'],
            ['name' => 'ساتان مطرز'],
        ];

        DB::table('fabric_types')->insert($fabrics);
    }
}