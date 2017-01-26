<?php

use Illuminate\Database\Seeder;
use Aska\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin= new Admin();
        $admin->name="Root";
        $admin->verified=true;
        $admin->token="admin";
        $admin->email="jaroslaw.bielec@pollub.edu.pl";
        $admin->password=crypt("Poziomd123$",10);
        $admin->save();
    }
}
