<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Payment;
use App\Models\Rental;
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
            'phone_number' => '08123234234',
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
            'phone_number' => '08123435345',
            'address' => 'Jl. Mencari Cinta Sejati',
            'role' => 'Member',
            'avatar' => 'user-avatar/default.png',
            'email_verified_at' => now(),
            'password' => bcrypt('12345'),
            'remember_token' => Str::random(10),
        ]);

        // Type Seeder

        Type::create([
            'type_name' => 'Car',
            'type_slug' => 'car'
        ]);

        Type::create([
            'type_name' => 'Motorcycle',
            'type_slug' => 'motorcycle'
        ]);

        Type::create([
            'type_name' => 'Bicyle',
            'type_slug' => 'bicyle'
        ]);

        Type::create([
            'type_name' => 'mboh1',
            'type_slug' => 'mboh1'
        ]);

        Type::create([
            'type_name' => 'mboh2',
            'type_slug' => 'mboh2'
        ]);

        Type::create([
            'type_name' => 'mboh3',
            'type_slug' => 'mboh3'
        ]);

        Type::create([
            'type_name' => 'mboh4',
            'type_slug' => 'mboh4'
        ]);

        Type::create([
            'type_name' => 'mboh5',
            'type_slug' => 'mboh5'
        ]);

        // Brand Seeder
        Brand::create([
            'type_id' => 1,
            'brand_name' => 'Toyota',
            'brand_slug' => 'toyota',
            'brand_image' => 'brand-logo/default.png'
        ]);

        Brand::create([
            'type_id' => 1,
            'brand_name' => 'Daihatsu',
            'brand_slug' => 'daihatsu',
            'brand_image' => 'brand-logo/default.png'
        ]);

        // Specs Seeder
        VehicleSpec::create([
            'id_type' => 1,
            'id_brand' => 1,
            'vehicle_name' => 'Toyota Supra 1000cc',
            'vehicle_slug' => 'toyota-supra-1000cc',
            'number_plate' => 'K 6066 KIB',
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
            'id_brand' => 1,
            'vehicle_name' => 'Toyota Alphard',
            'vehicle_slug' => 'toyota-alphard',
            'number_plate' => 'K 8932 OAS',
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
            'id_brand' => 2,
            'vehicle_name' => 'Daihatsu Sigra',
            'vehicle_slug' => 'daihatsu-sigra',
            'number_plate' => 'K 5229 UB',
            'vehicle_image' => 'vehicle-image/default.png',
            'vehicle_year' => 2020,
            'vehicle_color' => 'red',
            'vehicle_seats' => 5,
            'vehicle_status' => 'Available',
            'rent_price' => 250000,
            'vehicle_description' => 'None'
        ]);

        Rental::create([
            'transaction_code' => 'TRX000000001',
            'user_id' => 3,
            'id_vehicle' => 2,
            'start_rent_date' => now(),
            'end_rent_date' => now(),
            'status' => 'Not Picked',
            'guarante_rent_1' => 'guarante-rent/default.pdf',
            'rent_price' => 900000
        ]);

        Payment::create([
            'transaction_code' => 'TRX000000001',
            'id_rental' => 1,
            'cashier' => 'Midtrans',
            'payment_type' => 'transfer_bank',
            'paid_date' => now(),
            'payer_name' => 'Member 2',
            'bank' => 'BNI',
            'no_rek' => '03929409234',
            'paid_total' => 900000
        ]);
    }
}