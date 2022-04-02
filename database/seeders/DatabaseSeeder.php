<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Type;
use App\Models\User;
use App\Models\VehicleSpec;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // User Seeder
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone_number' => '081234567890',
            'address' => 'Jl. Mencari Cinta Sejati',
            'role' => 'Admin',
            'avatar' => 'user-avatar/default.png',
            'email_verified_at' => now(),
            'password' => bcrypt('12345'),
            'remember_token' => Str::random(10),
        ]);

        // Member 1
        User::create([
            'name' => 'Member 1',
            'email' => 'member1@gmail.com',
            'phone_number' => '081234567890',
            'address' => 'Jl. Mencari Cinta Sejati',
            'role' => 'Member',
            'avatar' => 'user-avatar/default.png',
            'email_verified_at' => now(),
            'password' => bcrypt('12345'),
            'remember_token' => Str::random(10),
        ]);

        // Member 2
        User::create([
            'name' => 'Member 2',
            'email' => 'member2@gmail.com',
            'phone_number' => '081234567890',
            'address' => 'Jl. Mencari Cinta Sejati',
            'role' => 'Member',
            'avatar' => 'user-avatar/default.png',
            'email_verified_at' => now(),
            'password' => bcrypt('12345'),
            'remember_token' => Str::random(10),
        ]);

        // Brand Seeder
        Brand::create([
            'brand_name' => 'Toyota',
            'brand_image' => 'brand-logo/default.png'
        ]);

        Brand::create([
            'brand_name' => 'Daihatsu',
            'brand_image' => 'brand-logo/default.png'
        ]);

        // Type Seeder

        Type::create([
            'brand_id' => 1,
            'type_name' => 'Car'
        ]);

        Type::create([
            'brand_id' => 2,
            'type_name' => 'Car'
        ]);

        // Specs Seeder
        VehicleSpec::create([
            'id_type' => 1,
            'vehicle_name' => 'Toyota Supra 1000cc',
            'vehicle_image' => 'vehicle-image/default.png',
            'vehicle_year' => 2016,
            'vehicle_color' => 'white',
            'vehicle_seats' => 2,
            'vehicle_status' => 'Available',
            'rent_price' => 1200000,
            'vehicle_description' => 'None'
        ]);

        VehicleSpec::create([
            'id_type' => 1,
            'vehicle_name' => 'Toyota Alphard',
            'vehicle_image' => 'vehicle-image/default.png',
            'vehicle_year' => 2017,
            'vehicle_color' => 'white',
            'vehicle_seats' => 8,
            'vehicle_status' => 'Available',
            'rent_price' => 850000,
            'vehicle_description' => 'None'
        ]);

        VehicleSpec::create([
            'id_type' => 2,
            'vehicle_name' => 'Daihatsu Sigra',
            'vehicle_image' => 'vehicle-image/default.png',
            'vehicle_year' => 2020,
            'vehicle_color' => 'red',
            'vehicle_seats' => 5,
            'vehicle_status' => 'Available',
            'rent_price' => 250000,
            'vehicle_description' => 'None'
        ]);
    }
}