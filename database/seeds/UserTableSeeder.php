<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_client = Role::where('name', 'Client')->first();
        $role_serv_prov = Role::where('name', 'Service Provider')->first();
        $client = new User();
        $client->name = 'Client Name';
        $client->email = 'client@example . com';
        $client->password = bcrypt('secret');
        $client->save();
        $client->roles()->attach($role_client);
        $serv_prov = new User();
        $serv_prov->name = 'Service Provider Name';
        $serv_prov->email = 'servprov@example . com';
        $serv_prov->password = bcrypt('secret');
        $serv_prov->save();
        $serv_prov->roles()->attach($role_serv_prov);
    }
}
