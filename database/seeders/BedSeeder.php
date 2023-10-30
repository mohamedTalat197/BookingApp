<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bed;


class BedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bed::create([
        //     'room_id' => 1,
        //     'bed_type_id' => 1,
        //     'name' => '',
        // ]);

        // Bed::create([
        //     'room_id' => 1,
        //     'bed_type_id' => 1,
        //     'name' => '',
        // ]);

         Bed::create([
             'room_id' => 1,
             'bed_type_id' => 2,
             'name' => '',
         ]);

        Bed::create([
            'room_id' => 4,
            'bed_type_id' => 2,
            'name' => '',
         ]);

        Bed::create([
            'room_id' => 4,
            'bed_type_id' => 1,
            'name' => '',
        ]);


    }
}
