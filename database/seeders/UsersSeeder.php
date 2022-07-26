<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'albishikhaild9@gmail.com',
            'password' => '$2y$10$jJgou27Ay.hY8gteHxnLZOntZqNeg5GILKpzF51BBOuzit66FsHB2',
        ]);
    }
}
