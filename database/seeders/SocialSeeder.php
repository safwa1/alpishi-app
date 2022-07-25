<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('socials')->insert([
            [
                'name' => 'phone',
                'data' => '+966 56 210 0009'
            ],
            [
                'name' => 'email',
                'data' => 'albishikhaild9@gmail.com'
            ],
            [
                'name' => 'whatsapp',
                'data' => 'https://wa.me/+966562100009'
            ],
            [
                'name' => 'telegram',
                'data' => 'https://t.me/albishi9'
            ],
            [
                'name' => 'instagram',
                'data' => '#'
            ],[
                'name' => 'snapchat',
                'data' => '#'
            ],[
                'name' => 'facebook',
                'data' => '#'
            ],[
                'name' => 'twitter',
                'data' => '#'
            ],
        ], ['name', 'data']);
    }
}
