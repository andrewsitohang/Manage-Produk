<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    
    {
        ProductCategory::create([
            "name" => "Alat Olahraga"
        ]);
        ProductCategory::create([
            "name" => "Alat Musik"
        ]);
        User::create([
            "email" => "admin@gmail.com",
            "name" => "Admin",
            "candidate" > "Web Programmer",
            "password" => "admin",
        ]);
    }
}
