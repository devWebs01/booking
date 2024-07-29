<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'City Car'],
            ['name' => 'MPV'],
            ['name' => 'SUV'],
            // ['name' => 'Van'],
            // ['name' => 'Mini Bus'],
            // ['name' => 'Bus'],
            ['name' => 'Sedan'],
            // ['name' => 'Coupe'],
            // ['name' => 'Supercar'],
            // ['name' => 'Luxury MPV'],
            // ['name' => 'Hybrid'],
        ];

        DB::table('categories')->insert($categories);
    }
}
