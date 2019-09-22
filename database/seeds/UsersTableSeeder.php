<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin Admin',
            'email' => 'admin@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('dev123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $user->assignRole('super-admin');
    }
}
