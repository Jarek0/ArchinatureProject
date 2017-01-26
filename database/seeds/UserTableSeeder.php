<?php

use Illuminate\Database\Seeder;
use Aska\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user= new User();
        $user->name="Test";
        $user->email="jaroslaw.bielec@pollub.edu.pl";
        $user->password=crypt("poziomd123",10);
        $user->save();
    }
}
