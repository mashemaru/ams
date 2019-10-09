<?php

use App\ScoringType;
use Illuminate\Database\Seeder;

class ScoreTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ScoringType::create([
            'scoring_name'  => 'Narrative',
            'scoring_description'  => 'Narrative',
        ]);
    }
}
