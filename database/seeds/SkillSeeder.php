<?php

use App\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            ['skill_name' => 'Plumbing', 'skill_rate' => 150.00],
            ['skill_name' => 'Carpentry', 'skill_rate' => 150.00],
            ['skill_name' => 'Automotive', 'skill_rate' => 150.00],
            ['skill_name' => 'Machinery', 'skill_rate' => 150.00],
            ['skill_name' => 'Electrical', 'skill_rate' => 150.00],
            ['skill_name' => 'Electronics', 'skill_rate' => 150.00],
            ['skill_name' => 'Laundry', 'skill_rate' => 150.00],
            ['skill_name' => 'Painting', 'skill_rate' => 150.00],
            ['skill_name' => 'Driving', 'skill_rate' => 150.00],
            ['skill_name' => 'Housekeeping', 'skill_rate' => 150.00],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('skills')->truncate();

        Skill::insert($skills);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
