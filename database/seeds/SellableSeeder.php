<?php

use App\Models\Role;
use App\Models\User;
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
        $service->price = 130;
        $service->image = null;
        $service->description = 'This is the service description. It should describe the service to sell';
        $service->owner()->associate($serv_prov);

        $service->save();

        $serv_prov = User::find(3);

        $service = new Sellable();
        $service->type = 1;
        $service->name = 'Service Name 2';
        $service->price = 55;
        $service->image = null;
        $service->description = 'This is the service 2 description. It should describe the service 2 to sell';
        $service->owner()->associate($serv_prov);

        $service->save();

        $serv_prov = User::find(3);

        $service = new Sellable();
        $service->type = 1;
        $service->name = 'Service Name 3';
        $service->price = 99.95;
        $service->image = null;
        $service->description = 'This is the service 3 description. It should describe the service 3 to sell';
        $service->owner()->associate($serv_prov);

        $service->save();
    }
}
