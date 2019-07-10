<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProviderTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testDashboardAsProvider()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/dashboard')
                    ->assertSee('Service Marketplace Dashboard');
        });
    }
}
