<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\City;




class PropertiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_property_owner_has_access_to_properties_feature()
    {
    $owner = User::factory()->create(['role_id' => Role::ROLE_OWNER]);
    $response = $this->actingAs($owner)->getJson('/api/owner/properties');
    $response->assertStatus(200);
    }

    public function test_user_does_not_have_access_to_properties_feature()
{
$owner = User::factory()->create(['role_id' => Role::ROLE_USER]);
$response = $this->actingAs($owner)->getJson('/api/owner/properties');
$response->assertStatus(403);
}


public function test_property_owner_can_add_property()
{
$owner = User::factory()->create(['role_id' => Role::ROLE_OWNER]);
$response = $this->actingAs($owner)->postJson('/api/owner/properties', [
'name' => 'My property',
'city_id' => City::value('id'),
'address_street' => 'Street Address 1',
'address_postcode' => '12345',
'lat' => 10,
'long' => 15,
]);
$response->assertSuccessful();
$response->assertJsonFragment(['name' => 'My property']);
}

}
