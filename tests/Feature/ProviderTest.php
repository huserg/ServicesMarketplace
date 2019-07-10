<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProviderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testAccessDashboardAsProvider() {

        $client = factory(User::class)->states('Provider')->make();
        $client->roles()->attach(factory(Role::class)->states('Provider')->make());

        $response = $this->actingAs($client)
            ->get('/dashboard');
        $response->assertOk();
    }

    public function testGetOwnSellablesListAsProvider() {

        $client = factory(User::class)->states('Provider')->make();
        $client->roles()->attach(factory(Role::class)->states('Provider')->make());

        $response = $this->actingAs($client)
            ->get('/dashboard/sellable');
        $response->assertOk()
            ->assertViewHas('sellables');
    }

    public function testGetReservationListAsProvider() {

        $client = factory(User::class)->states('Provider')->make();
        $client->roles()->attach(factory(Role::class)->states('Provider')->make());

        $response = $this->actingAs($client)
            ->get('/dashboard/orders');
        $response->assertOk()
            ->assertViewHas('orders');
    }

    public function testAddSellable () {

        $client = factory(User::class)->states('Provider')->make();
        $client->roles()->attach(factory(Role::class)->states('Provider')->make());

        $response = $this->actingAs($client)
            ->get('/dashboard/sellable/add');
        $response->assertSee('Add a new sellable');
    }

}
