<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Sellable;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testGetSellableListAsClient() {

        $client = factory(User::class)->make();
        $client->roles()->attach(factory(Role::class)->make());

        $response = $this->actingAs($client)
            ->get('/');
        $response->assertOk()
            ->assertViewHas('sellables');
    }

    public function testGetSellableDetailAsClient() {

        $client = factory(User::class)->make();
        $client->roles()->attach(factory(Role::class)->make());

        $sellable = factory(Sellable::class)->make();

        $response = $this->actingAs($client)
            ->get('/details/' . $sellable->id);
        $response->assertOk()
            ->assertViewHas('sellable');
    }

    public function testAccessDashboardAsClient() {
        $client = factory(User::class)->make();
        $client->roles()->attach(factory(Role::class)->make());

        $response = $this->actingAs($client)
            ->get('/dashboard');
        $response->assertStatus('401');
    }


}
