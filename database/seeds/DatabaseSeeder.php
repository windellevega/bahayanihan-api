<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TransactionStatusSeeder::class);
        $this->call(ApplicationStatusSeeder::class);
        $this->call(SkillSeeder::class);
    }
}
