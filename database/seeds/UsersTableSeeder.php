<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'role_id'   => '2',
            'name'      => 'Admin',
            'username'  => 'admin',
            'email'     => 'admin@mail.com',
            'password'  => bcrypt('admin@mail.com'),
        ]);

        \Illuminate\Support\Facades\DB::table('users')->insert([
            'role_id'   => '1',
            'name'      => 'User',
            'username'  => 'user',
            'email'     => 'user@mail.com',
            'password'  => bcrypt('user@mail.com'),
        ]);
    }
}
