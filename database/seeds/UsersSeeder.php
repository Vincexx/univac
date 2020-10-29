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
                'name' => 'CvSU Main',
                'email' => 'cvsu@gmail.com',
                'password' => Hash::make('password'),
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
