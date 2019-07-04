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
    public function testGetSellableListAsVisitor() {
        $response = $this->get('/');
        $response->assertOk()
            ->assertViewHas('sellables');
    }
}
