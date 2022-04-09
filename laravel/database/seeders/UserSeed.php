<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userA = new User([
            'name' => 'Usuario A',
            'email' => 'usera@tcc',
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ]);
        $userA->save();

        $userB = new User([
            'name' => 'Usuario B',
            'email' => 'userb@tcc',
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
            //'secret' => Crypt::encryptString('userb@tcc'),
        ]);
        $userB->save();
    }
}
