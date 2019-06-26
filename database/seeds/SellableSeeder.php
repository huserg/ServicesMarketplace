<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\Sellable;
use App\Models\SellableField;

class SellableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serv_prov = Role::with('users')->where('name', 'Service Provider')->first()->users()->first();

        $service = new Sellable();
        $service->type = 1;
        $service->name = 'Service Name';
        $service->image = null;
        $service->description = 'This is the service description. It should describe the service to sell';
        $service->owner()->associate($serv_prov);

        $service->save();
    }
}
