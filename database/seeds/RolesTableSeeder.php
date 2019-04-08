<?php

use Illuminate\Database\Seeder;

use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin       = new Role();
        $admin->name = 'admin';
        $admin->save();

        $client       = new Role();
        $client->name = 'client';
        $client->save();

        $blocked       = new Role();
        $blocked->name = 'blocked';
        $blocked->save();
    }
}
