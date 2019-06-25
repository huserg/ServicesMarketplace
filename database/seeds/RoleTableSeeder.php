<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role();
        $role_admin->name = 'Administrator';
        $role_admin->description = 'Plateform administrator';
        $role_admin->save();

        $role_client = new Role();
        $role_client->name = 'Client';
        $role_client->description = 'Plateform client';
        $role_client->save();

        $role_serv_prov = new Role();
        $role_serv_prov->name = 'Service Provider';
        $role_serv_prov->description = 'Provide service to sell';
        $role_serv_prov->save();

        $role_prop_manager = new Role();
        $role_prop_manager->name = 'Property Manager';
        $role_prop_manager->description = 'Manage a link to API';
        $role_prop_manager->save();
    }
}
