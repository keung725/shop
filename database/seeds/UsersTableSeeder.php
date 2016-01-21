<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create the role
        $siteowner = Role::create(array(
            'name' => 'siteowner',
            'display_name' => 'Site Owner',
            'description' => 'A Site Owner',
        ));

        $admin = Role::create(array(
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'A Site Admin',
        ));

        $member = Role::create(array(
            'name' => 'member',
            'display_name' => 'Member',
            'description' => 'A Site Member',
        ));

        // Create the user
        $user = User::create(array(
            'name' => null,
            'email' => 'keung725@hotmail.com',
            'password' => bcrypt('123456'),
        ));

        // Assign roles using one of several methods:

        // attaching
        $user->roles()->attach($siteowner->id);
        $user->roles()->attach($admin->id);
        $user->roles()->attach($member->id);

    }
}
