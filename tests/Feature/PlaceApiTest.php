<?php

namespace Tests\Feature;

use App\Models\places;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaceApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_place()
    {
        $response = $this->postJson('/api/places', [
            'name' => 'Praça da Liberdade',
            'city' => 'Belo Horizonte',
            'state' => 'MG',
        ]);

        $response->assertStatus(201)->assertJson(['message' => 'place successfully created']);
    }

    public function test_can_list_places()
    {
        places::factory()->count(3)->create();

        $response = $this->getJson('/api/places');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_show_place_by_slug()
    {
        $place = places::factory()->create([
            'name' => 'Parque Ibirapuera',
            'slug' => 'parque-ibirapuera',
            'city' => 'São Paulo',
            'state' => 'SP'
        ]);

        $response = $this->getJson("/api/places/{$place->slug}");

        $response->assertStatus(200);
    }

    public function test_returns_404_for_non_existing_slug()
    {
        $response = $this->getJson('/api/places/slug-nao-existe');

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Place not found']);
    }

    public function test_can_update_place()
    {
        $place = places::factory()->create([
            'name' => 'Lagoa da Pampulha',
            'slug' => 'lagoa-da-pampulha',
            'city' => 'Belo Horizonte',
            'state' => 'MG'
        ]);

        $response = $this->putJson("/api/places/{$place->slug}", [
            'name' => 'Lagoa da Pampulha Atualizada',
            'city' => 'BH',
            'state' => 'MG',
        ]);

        $response->assertStatus(201)->assertJson(['message' => 'place successfully updated']);
    }

    public function test_can_delete_place()
    {
        $place = places::factory()->create();

        $response = $this->deleteJson("/api/places/{$place->slug}");

        $response->assertStatus(201)->assertJson(['message' => 'Place deleted successfully']);
    }
}
