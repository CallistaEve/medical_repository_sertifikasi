<?php

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ItemSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // Seeder pengguna
    User::create([
        'name' => 'Karen Admin',
        'email' => 'admin_karen@example.com',
        'password' => Hash::make('password'),
        'role' => 'Admin',
    ]);

    User::create([
        'name' => 'Andy Pharma',
        'email' => 'pharma_andy@example.com',
        'password' => Hash::make('password'),
        'role' => 'Pharmacist',
    ]);

    User::create([
        'name' => 'Lisa Tech',
        'email' => 'tech_lisa@example.com',
        'password' => Hash::make('password'),
        'role' => 'Technician',
    ]);

    // Panggil ItemSeeder untuk menambah data barang
    $this->call(ItemSeeder::class);

}
}
