<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'mohamed zakaria',
            'email'=> 'mohzak32@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123456789'),

        ]);
    }
}
