<?php

use Illuminate\Database\Seeder;

class CategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoris')->insert([
            'name' => 'baju'
        ]);

        DB::table('categoris')->insert([
            'name' => 'celana'
        ]);

        DB::table('categoris')->insert([
            'name' => 'jaket'
        ]);

        DB::table('categoris')->insert([
            'name' => 'sepatu'
        ]);



    }
}
