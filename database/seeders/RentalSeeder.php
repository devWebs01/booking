<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;


class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shop::create([
            'name' => 'Aquina Rent Jambi',
            'thumbnail' => 'https://lh5.googleusercontent.com/p/AF1QipOj9a4uSsUFj-lFtu3jEkxKZMJalrFWHMUKlqY4=w408-h544-k-no',
            'url_maps' => 'https://maps.app.goo.gl/QfMM9mXvq97hZgB38',
            'phone_number' => '085266930933',
            'address' => 'Jl. Kabia, Handil Jaya, Kec. Jelutung, Kota Jambi, Jambi 36125',
            'latitude' => -1.630533739139556,
            'longitude' => 103.62290795391067,
        ]);
    }
}
