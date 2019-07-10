<?php

namespace Tests\Feature;

use App\Models\Sellable;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VisitorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testGetSellableListAsVisitor() {
        $response = $this->get('/');
        $response->assertOk()
            ->assertViewHas('sellables');
    }

    public function testGetSellableDetailUnauthorized() {
        $response = $this->get('/details/1');
        $response->assertRedirect('/login');
    }


    public function testGetDashboardUnauthorized() {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

}

