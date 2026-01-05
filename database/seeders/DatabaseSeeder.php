<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\FabricType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);


        FabricType::create([
            'name' => 'شيفون',
        ]);

        $this->call(CategorySeeder::class);
        $this->call(GovernoratesSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProdImgSeeder::class);

    }
}
