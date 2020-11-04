<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'cvsu@gmail.com')->first();

        if(!$user) {
            User::create([
                'name' => 'CvSU IDO',
                'email' => 'ido2020@cvsu.edu.ph',
                'password' => Hash::make('cvsuido2020'),
                'role' => 'admin',
            ]);

            User::create([
                'name' => 'Vince Pitagan',
                'email' => 'vince@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
        }
    }
}
