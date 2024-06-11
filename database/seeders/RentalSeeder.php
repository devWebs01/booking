<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rental;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Path to the JSON file
        $path = public_path('leaflet/locationRental.json');

        // Check if the file exists
        if (!File::exists($path)) {
            Log::error("File not found: $path");
            return;
        }

        // Read the JSON file
        $json = File::get($path);

        // Decode JSON data to PHP array
        $data = json_decode($json, true);

        // Check if JSON decoding was successful
        if ($data === null) {
            Log::error("Error decoding JSON file: $path");
            return;
        }

        // Loop through the data and create entries in the database
        foreach ($data as $rental) {
            // Skip rentals with less than 5 reviews
            if (!isset($rental['review_count']) || $rental['review_count'] < 5) {
                Log::info("Skipping rental: {$rental['name']} due to insufficient reviews ({$rental['review_count']} reviews).");
                continue;
            }

            // Create a user for each rental (or reuse an existing one)
            $user = User::factory()->create();

            // Handle missing keys by providing defaults
            $address = isset($rental['full_address']) ? $rental['full_address'] : 'No Address Provided';
            $description = isset($rental['description']) ? $rental['description'] : Str::random(20);

            Rental::create([
                'name' => $rental['name'],
                'thumbnail' => $rental['photos'],
                'url_maps' => $rental['place_link'],
                'phone_number' => $rental['phone_number'],
                'address' => $address,
                'latitude' => $rental['latitude'],
                'longitude' => $rental['longitude'],
                'user_id' => $user->id,
                'description' => $description,
            ]);
        }
    }
}
