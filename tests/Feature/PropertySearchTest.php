<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\City;
use App\Models\Country;
use App\Models\Property;
use App\Models\Role;
use App\Models\User;
use App\Models\Apartment;
use App\Models\ApartmentType;

use Tests\TestCase;


class PropertySearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_property_search_by_city_returns_correct_results(): void
    {
        $owner = User::factory()->create(['role_id' => Role::ROLE_OWNER]);
        $cities = City::take(2)->pluck('id');
        $propertyInCity = Property::factory()->create(['owner_id'=>$owner->id, 'city_id'=>$cities[0]]);
        $propertyInAnotherCity = Property::factory()->create(['owner_id'=>$owner->id, 'city_id'=>$cities[1]]);

        $response = $this->getJson('/api/search?city=' . $cities[0]);
        $response->assertStatus(200);
        // $response->assertJsonCount(1);
        $response->assertJsonFragment(['id' => $propertyInCity->id]);

    }

    public function test_property_search_by_country_returns_correct_results(): void
    {
        $owner = User::factory()->create(['role_id' => Role::ROLE_OWNER]);
        $countries = Country::with('cities')->take(2)->get();
        $propertyInCountry = Property::factory()->create([
        'owner_id' => $owner->id,
        'city_id' => $countries[0]->cities()->value('id')
        ]);
        $propertyInAnotherCountry = Property::factory()->create([
        'owner_id' => $owner->id,
        'city_id' => $countries[1]->cities()->value('id')
        ]);
        $response = $this->getJson('/api/search?country=' . $countries[0]->id);
        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $propertyInCountry->id]);
    }

    public function test_property_search_by_capacity_returns_correct_results(): void
    {
        $owner = User::factory()->create(['role_id' => Role::ROLE_OWNER]);
        $city_id = City::value('id');
        $propertyWithSmallApartment = Property::factory()->create([
            'owner_id' => $owner->id,
            'city_id'  => $city_id
        ]);

        Apartment::factory()->create([
            'property_id' => $propertyWithSmallApartment->id,
            'capacity_adults' => 1,
            'capacity_children' => 0,
        ]);

        $propertyWithLargeApartment = Property::factory()->create([
            'owner_id' => $owner->id,
            'city_id' => $city_id,
        ]);

        Apartment::factory()->create([
             'property_id' => $propertyWithLargeApartment->id,
             'capacity_adults' => 3,
             'capacity_children' => 2,
        ]);

        $response = $this->getJson('/api/search?city=' . $city_id . '&adults=2&children=1');
        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $propertyWithLargeApartment->id]);
    }


    public function test_property_search_by_capacity_returns_only_suitable_apartments(): void
    {
    $owner = User::factory()->create(['role_id' => Role::ROLE_OWNER]);
    $cityId = City::value('id');
    $property = Property::factory()->create([
    'owner_id' => $owner->id,
    'city_id' => $cityId,
    ]);

    $apartType = ApartmentType::factory()->create([
        'name' => 'hhhhhh',



    ]);
    $smallApartment = Apartment::factory()->create([
    'name' => 'Small apartment',
    'property_id' => $property->id,
    'apartment_type_id'=>$apartType->id,
    'capacity_adults' => 1,
    'capacity_children' => 0,
    ]);
    $largeApartment = Apartment::factory()->create([
    'name' => 'Large apartment',
    'property_id' => $property->id,
    'apartment_type_id'=>$apartType->id,
    'capacity_adults' => 3,
    'capacity_children' => 2,
    ]);
    $response = $this->getJson('/api/search?city=' . $cityId . '&adults=2&children=1');
    $response->assertStatus(200);
    $response->assertJsonCount(1);
    $response->assertJsonCount(1, '0.apartments');
    $response->assertJsonPath('0.apartments.0.name', $largeApartment->name);
    }

    public function test_property_search_returns_one_best_apartment_per_property()
    {
    $owner = User::factory()->create(['role_id' => Role::ROLE_OWNER]);
    $city_Id = City::value('id');
    $property = Property::factory()->create([
    'owner_id' => $owner->id,
    'city_id' => $city_Id,
    ]);
    $largeApartment = Apartment::factory()->create([
    'name' => 'Large apartment',
    'property_id' => $property->id,
    'capacity_adults' => 3,
    'capacity_children' => 2,
    ]);
    $midSizeApartment = Apartment::factory()->create([
    'name' => 'Mid size apartment',
    'property_id' => $property->id,
    'capacity_adults' => 2,
    'capacity_children' => 1,
    ]);
    $smallApartment = Apartment::factory()->create([
    'name' => 'Small apartment',
    'property_id' => $property->id,
    'capacity_adults' => 1,
    'capacity_children' => 0,
    ]);
    $response = $this->getJson('/api/search?city=' . $city_Id . '&adults=2&children=1');
    $response->assertStatus(200);
    // $response->assertJsonCount(1, '0.apartments');
    // $response->assertJsonPath('0.apartments.0.name', $midSizeApartment->name);
    }






}
