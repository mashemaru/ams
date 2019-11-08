<?php

use App\User;
use Illuminate\Support\Arr;
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
        $role = ['member','faculty'];
        $user = User::create([
            'name' => 'Admin Admin',
            'email' => 'admin@test.com',
            'user_type' => 'admin',
            'password' => Hash::make('dev123'),
        ]);
        $user->assignRole('super-admin');

        $users = factory(App\User::class, 50)
            ->create()
            ->each(function ($user) use($role) {
                $user->assignRole(Arr::random($role));
            });
    }
}
