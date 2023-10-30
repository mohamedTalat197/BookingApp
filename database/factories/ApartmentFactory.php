<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\City;
use App\Models\Role;
use App\Models\User;
use App\Models\Property;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{

    public function definition(): array
    {
        return [
            'property_id' => Property::value('id'),
            'name' => fake()->text(20),
            'capacity_adults' => rand(1,5),
            'capacity_children' => rand(1,5)
        ];
    }
}
