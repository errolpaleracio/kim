<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'kim martin',
                    'username' => 'kim',
                    'email' => 'kim@gmail.com',
                    'password' => bcrypt('password'),
                    'branch_id' => 1
                ],               
                [
                    'name' => 'dianna galang',
                    'username' => 'dianna',
                    'email' => 'dianna@gmail.com',
                    'password' => bcrypt('password'),
                    'branch_id' => 2
                ],                
                [
                    'name' => 'admin',
                    'username' => 'admin',
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('password'),
                    'branch_id' => null
                ],

            ]
        );
    }
}
