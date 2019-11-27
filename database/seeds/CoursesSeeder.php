<?php

use App\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Course::class, 50)->create();
    }
}
