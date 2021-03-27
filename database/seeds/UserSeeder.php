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
        DB::table('users')->insert([
            'name' => 'Andito',
            'email' => 'Andito763@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('bismillah'),
            'address' => 'Ulutedong',
            'phone' => '085298973249'

        ]);
    }
}
