<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin            = new User();
        $admin->name      = 'admin';
        $admin->email     = 'admin@admin.com';
        $admin->password  = bcrypt('admin111');
        $admin->role_id  = 1;
        $admin->save();

        $user            = new User();
        $user->name      = 'user';
        $user->email     = 'user@user.com';
        $user->password  = bcrypt('user111');
        $user->role_id  = 2;
        $user->save();

        $blocked            = new User();
        $blocked->name      = 'block';
        $blocked->email     = 'block@block.com';
        $blocked->password  = bcrypt('block111');
        $blocked->role_id  = 3;
        $blocked->save();
    }
}
