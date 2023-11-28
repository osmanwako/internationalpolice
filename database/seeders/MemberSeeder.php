<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *`username`, `email`, `profile`, `password`,expiredate,
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            'username' => 'members@eapcco.org',
            'email' =>  'members@feapcco.com',
            'profile' =>  'member.jpg',
            'expiredate' =>  now(),
            'password' => Hash::make('2022_ethmember@eapcco')
        ]);
    }
}
