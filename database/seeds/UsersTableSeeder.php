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

        $role_Admin= Role::where('name','admin')->first();

        $admin= new User();
        $admin->email='amanuel0805@gmail.com';
        $admin->first_name='amanuelAdmin';
        $admin->password=bcrypt("admin");
        $admin->save();
        $admin->roles()->attach($role_Admin);

    }
}
