<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;


class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Apartment::create([
            'apartment_type_id' => 1,
            'property_id' => 2,
            'name' => 'Large Room',
            'capacity_adults' => 3,
            'capacity_children' => 2,
            'size' => 50,
             ]);
             Apartment::create([
                'apartment_type_id' => 1,
                'property_id' => 2,
                'name' => 'Large Room',
                'capacity_adults' => 2,
                'capacity_children' => 1,
                'size' => 50,
                 ]);



    }
}
