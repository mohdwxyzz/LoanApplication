<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            [

                'name'=>'demo',
                'email'=>'demo@gmail.com',
                'password'=>\Hash::make('password'),
            ],[

                'name'=>'test',
                'email'=>'test@gmail.com',
                'password'=>\Hash::make('password'),
            ]
        ])
    }
}
