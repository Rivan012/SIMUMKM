<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table("produks")->insert([
            'kategori_id' => 1, // Pastikan KategoriSeeder dijalankan lebih dulu
            'name' => 'Italian Pizza',
            'description' => 'Extra cheese, tomato, and basil leaf.',
            'price' => 85000,
            'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&q=80&w=500',
            'stock' => 50,
            'is_active' => true,
        ]);
        \DB::table("produks")->insert([
            'kategori_id' => 1, // Pastikan KategoriSeeder dijalankan lebih dulu
            'name' => 'Italian Pizza',
            'description' => 'Extra cheese, tomato, and basil leaf.',
            'price' => 85000,
            'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&q=80&w=500',
            'stock' => 50,
            'is_active' => true,
        ]);
        \DB::table("produks")->insert([
            'kategori_id' => 1, // Pastikan KategoriSeeder dijalankan lebih dulu
            'name' => 'Italian Pizza',
            'description' => 'Extra cheese, tomato, and basil leaf.',
            'price' => 85000,
            'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&q=80&w=500',
            'stock' => 50,
            'is_active' => true,
        ]);
        \DB::table("produks")->insert([
            'kategori_id' => 1, // Pastikan KategoriSeeder dijalankan lebih dulu
            'name' => 'Italian Pizza',
            'description' => 'Extra cheese, tomato, and basil leaf.',
            'price' => 85000,
            'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&q=80&w=500',
            'stock' => 50,
            'is_active' => true,
        ]);
        \DB::table("produks")->insert([
            'kategori_id' => 1, // Pastikan KategoriSeeder dijalankan lebih dulu
            'name' => 'Italian Pizza',
            'description' => 'Extra cheese, tomato, and basil leaf.',
            'price' => 85000,
            'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&q=80&w=500',
            'stock' => 50,
            'is_active' => true,
        ]);
        \DB::table("produks")->insert([
            'kategori_id' => 1, // Pastikan KategoriSeeder dijalankan lebih dulu
            'name' => 'Italian Pizza',
            'description' => 'Extra cheese, tomato, and basil leaf.',
            'price' => 85000,
            'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&q=80&w=500',
            'stock' => 50,
            'is_active' => true,
        ]);
        \DB::table("produks")->insert([
            'kategori_id' => 1, // Pastikan KategoriSeeder dijalankan lebih dulu
            'name' => 'Italian Pizza',
            'description' => 'Extra cheese, tomato, and basil leaf.',
            'price' => 85000,
            'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&q=80&w=500',
            'stock' => 50,
            'is_active' => true,
        ]);
    }
}
