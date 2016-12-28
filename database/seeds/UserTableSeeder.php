<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_reception = Role::where('name', 'Reception')->first();
        $role_coordinator = Role::where('name', 'Coordinator')->first();
        $role_admin = Role::where('name', 'Admin')->first();
        $role_faculty = Role::where('name', 'Faculty')->first();
        
        $reception = new User();
        $reception->name = 'Partei';
        $reception->email = 'reception@example.com';
        $reception->password = bcrypt('reception');
        $reception->save();
        $reception->roles()->attach($role_reception);

        $admin = new User();
        $admin->name = 'Samuel';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $coordinator = new User();
        $coordinator->name = 'Hmangaiha';
        $coordinator->email = 'hmangaiha@example.com';
        $coordinator->password = bcrypt('coordinator');
        $coordinator->save();
        $coordinator->roles()->attach($role_coordinator);

        $faculty = new User();
        $faculty->name = 'Patea';
        $faculty->email = 'patea@example.com';
        $faculty->password = bcrypt('patea');
        $faculty->save();
        $faculty->roles()->attach($role_faculty);
    }
}
