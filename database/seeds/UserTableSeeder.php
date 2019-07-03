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
        $role_admin = Role::where('name', 'Administrator')->first();

        $client = new User();
        $client->name = 'Client Name';
        $client->email = 'client@example.com';
        $client->street = 'Example street 22';
        $client->npa = '1234';
        $client->town = 'Example Town';
        $client->country = 'Suisse';
        $client->password = bcrypt('secret');
        $client->save();
        $client->roles()->attach($role_client);

        $serv_prov = new User();
        $serv_prov->name = 'Service Provider Name';
        $serv_prov->email = 'servprov@example.com';
        $serv_prov->password = bcrypt('secret');
        $serv_prov->street = 'Example street 22';
        $serv_prov->npa = '1234';
        $serv_prov->town = 'Example Town';
        $serv_prov->country = 'Suisse';
        $serv_prov->save();
        $serv_prov->roles()->attach($role_serv_prov);

        $admin = new User();
        $admin->name = 'Gaétan Huser';
        $admin->email = 'huser.gaetan@hotmail.com';
        $admin->password = bcrypt('Pass123$');
        $admin->street = 'That street';
        $admin->npa = '666';
        $admin->town = 'That town';
        $admin->country = 'Suisse';
        $admin->save();
        $admin->roles()->attach($role_admin);

    }
}
