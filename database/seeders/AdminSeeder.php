<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * SELECT `id`, `title`, `idno`, `fullname`, `username`, `email`, `profile`
     * , `create`, `edit`, `badge`, `delete`, `search`, `password`, 
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'idno' => '26503169',
            'title' => 'Mr.',
            'fullname' => 'Osman Wako',
            'username' => 'osmanwako2022@federal.et',
            'email' => 'admin@federal.com',
            'profile' => 'admin.jpg',
            'create' => 1,
            'delete' => 1,
            'password' => Hash::make('2022@EAPCCO_osman')
        ]);
    }
}
