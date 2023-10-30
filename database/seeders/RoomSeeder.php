<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;


class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create([
            'apartment_id' => 1,
            'room_type_id' => 2,
            'name' => 'Bedroom',
             ]);

             Room::create([
                'apartment_id' => 4,
                'room_type_id' => 2,
                'name' => 'Bedroom',
                 ]);
    }
}
