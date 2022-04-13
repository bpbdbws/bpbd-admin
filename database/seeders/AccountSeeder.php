<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newAdmin = new \App\Models\User;
        $newAdmin->name = 'Administrator';
        $newAdmin->email = 'admin@mail.com';
        $newAdmin->password = \Hash::make('12345678');

        $newAdmin->save();
    }
}
