<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil UserSeeder jika ada, atau pastikan user sudah ada
        // $this->call(UserSeeder::class); 

        // Panggil CategorySeeder yang baru dibuat
        $this->call(CategorySeeder::class);
    }
}
