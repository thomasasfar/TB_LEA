<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nama' => 'Admin',
            'username' => 'admin',
			'email' => 'admin@mail.com',
			'password' => bcrypt('admin'),
            'no_hp' => '088877776666',
            'role' => 'admin'
        ]);

        DB::table('users')->insert([
            'nama' => 'Customer1',
            'username' => 'customer1',
			'email' => 'customer1@mail.com',
			'password' => bcrypt('abcd1234'),
            'no_hp' => '081112344321',
            'role' => 'customer'
        ]);
    }
}
