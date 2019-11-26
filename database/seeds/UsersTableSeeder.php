<?php

use App\User;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
            'firstname' => 'Mash',
            'mi'   => 'C.',
            'surname' => 'Admin',
            'email' => 'admin@test.com',
            'user_type' => 'admin',
            'password' => Hash::make('dev123'),
        ]);
        $user->assignRole('super-admin');

        $users = factory(App\User::class, 50)
            ->create()
            ->each(function ($user) use($role) {
                $assign = Arr::random($role);
                $user->assignRole($assign);
                if($assign == 'faculty') {
                    $user->rank = Arr::random(['FT','PT']);
                    $user->save();
                    for($x = 0; $x <= rand(0,5); $x++) {
                        $user->faculty_teaching_experience_dlsu()->create([
                            'level' => Arr::random(['Elementary','Secondary','Tertiary']),
                            'years' => rand(0,20),
                            'inclusive_dates'   => Carbon::now()->subDays(rand(0, 100))->format('Y-m-d'),
                        ]);
                        $user->faculty_teaching_experience_other()->create([
                            'level' => Arr::random(['Elementary','Secondary','Tertiary']),
                            'years' => rand(0,20),
                            'school_name'   => Arr::random(['DLSU','Ateneo','UP','UST','UE']),
                            'inclusive_dates'   => Carbon::now()->subDays(rand(0, 100))->format('Y-m-d'),
                        ]);
                    }
                }
            });
    }
}
