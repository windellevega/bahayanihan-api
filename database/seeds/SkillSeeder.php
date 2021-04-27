<?php

use App\Models\Skill;
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
            ['skill_name' => 'Plumbing', 'skill_rate' => 150.00, 'picture_url' => 'assets/skill_pictures/plumbing.jpg'],
            ['skill_name' => 'Carpentry', 'skill_rate' => 150.00, 'picture_url' => 'assets/skill_pictures/carpentry.jpg'],
            ['skill_name' => 'Automotive', 'skill_rate' => 150.00, 'picture_url' => 'assets/skill_pictures/automotive.jpg'],
            ['skill_name' => 'Machinery', 'skill_rate' => 150.00, 'picture_url' => 'assets/skill_pictures/machinery.jpg'],
            ['skill_name' => 'Electrical', 'skill_rate' => 150.00, 'picture_url' => 'assets/skill_pictures/electrical.jpg'],
            ['skill_name' => 'Electronics', 'skill_rate' => 150.00, 'picture_url' => 'assets/skill_pictures/electronics.jpg'],
            ['skill_name' => 'Laundry', 'skill_rate' => 150.00, 'picture_url' => 'assets/skill_pictures/laundry.jpg'],
            ['skill_name' => 'Painting', 'skill_rate' => 150.00, 'picture_url' => 'assets/skill_pictures/painting.jpg'],
            ['skill_name' => 'Driving', 'skill_rate' => 150.00, 'picture_url' => 'assets/skill_pictures/driving.jpg'],
            ['skill_name' => 'Housekeeping', 'skill_rate' => 150.00, 'picture_url' => 'assets/skill_pictures/housekeeping.jpg'],
        ];

        //DB::statement('SET FOREIGN_KEY_CHECKS=0');

        //DB::table('skills')->truncate();

        Skill::insert($skills);

        //DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
