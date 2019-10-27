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
        ScoringType::insert([
            [
                'scoring_name'  => 'Narrative',
                'scoring_description'  => 'Narrative',
            ],
            [
                'scoring_name'  => 'Narrative w/ Score',
                'scoring_description'  => 'Narrative w/ Score',
            ],
            [
                'scoring_name'  => 'Narrative w/ Table',
                'scoring_description'  => 'Narrative w/ Table',
            ],
            [
                'scoring_name'  => 'Narrative w/ Table & Score',
                'scoring_description'  => 'Narrative w/ Table & Score',
            ],
        ]);
    }
}
