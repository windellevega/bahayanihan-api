<?php

use Illuminate\Database\Seeder;
use App\ApplicationStatus;

class ApplicationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $application_statuses = [
            ['status' => 'Pending'],
            ['status' => 'Accepted'],
            ['status' => 'Rejected'],
        ];

        //DB::statement('SET FOREIGN_KEY_CHECKS=0');

        //DB::table('application_statuses')->truncate();

        ApplicationStatus::insert($application_statuses);

        //DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
