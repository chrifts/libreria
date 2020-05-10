<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => '1',
            'password' => Hash::make('admin'),
        ]);

        DB::table('users')->insert([
            'name' => 'Cristian Schweizer',
            'email' => 'schweizercristian@gmail.com',
            'role' => '3',
            'subscribed' => '0',
            'password' => Hash::make('123456'),
        ]);
    }
}
