<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user=new Role();
        $role_user->name='Reception';
        $role_user->description='Normal User';
        $role_user->save();

        $role_user=new Role();
        $role_user->name='Admin';
        $role_user->description='Admin User';
        $role_user->save();

        $role_user=new Role();
        $role_user->name='Coordinator';
        $role_user->description='Coordinator User';
        $role_user->save();

        $role_user=new Role();
        $role_user->name='Faculty';
        $role_user->description='Faculty User';
        $role_user->save();

    }
}
