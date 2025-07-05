<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $this->command->warn("Tidak ada user ditemukan. Pastikan ada minimal 1 user di tabel users.");
            return;
        }

        $now = Carbon::now();

        $categories = [
            // Income categories
            ['name' => 'Gaji', 'type' => 'income', 'description' => null, 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Bonus', 'type' => 'income', 'description' => null, 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Hasil Investasi', 'type' => 'income', 'description' => null, 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Hadiah', 'type' => 'income', 'description' => null, 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Penjualan', 'type' => 'income', 'description' => null, 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pemasukan Lain', 'type' => 'income', 'description' => null, 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now],

            // Expense categories
            ['name' => 'Makanan & Minuman', 'type' => 'expense', 'description' => null, 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Transportasi', 'type' => 'expense', 'description' => null, 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Tagihan', 'type' => 'expense', 'description' => 'Listrik, Air, Internet, dll.', 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Belanja Bulanan', 'type' => 'expense', 'description' => null, 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Hiburan', 'type' => 'expense', 'description' => 'Film, Langganan, dll.', 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kesehatan', 'type' => 'expense', 'description' => null, 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pendidikan', 'type' => 'expense', 'description' => null, 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Cicilan & Hutang', 'type' => 'expense', 'description' => null, 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Donasi & Amal', 'type' => 'expense', 'description' => null, 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pengeluaran Lain', 'type' => 'expense', 'description' => null, 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('categories')->insert($categories);

        $this->command->info("Kategori berhasil ditambahkan untuk user {$user->email}.");
    }
}
