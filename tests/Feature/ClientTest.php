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
    public function testGetSellableListAsClient() {

        $client = factory(User::class)->make([
            'role' => Role::where('name', 'Client')->first(),
        ]);

        $response = $this->actingAs($client)
            ->get('/');
        $response->assertOk()
            ->assertViewHas('sellables');
    }

    public function testGetSellableDetailUnauthorized() {

        $sellable = factory(Sellable::class)->make(['id' => 1]);

        $response = $this->get('/details/1');
        $response->assertRedirect('/login');
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


}
