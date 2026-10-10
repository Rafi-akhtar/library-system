<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    \App\Models\Book::create([
        'judul'=>'Laut Bercerita',
        'penulis'=>'Leila S. Chudori',
        'penerbit'=>'Gramedia',
        'stok'=>10
    ]);
    
    \App\Models\Book::create([
        'judul'=>'Pulang',
        'penulis'=>'Tere Liye',
        'penerbit'=>'Republika',
        'stok' => 5
    ]);
    }
}

