<?php

use Illuminate\Database\Seeder;
use App\Models\TransactionStatus;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaction_statuses = [
            ['status' => 'Created'],
            ['status' => 'Accepted'],
            ['status' => 'Completed'],
            ['status' => 'Paid'],
            ['status' => 'Rejected'],
        ];

        //DB::statement('SET FOREIGN_KEY_CHECKS=0');

        //DB::table('transaction_statuses')->truncate();

        TransactionStatus::insert($transaction_statuses);

        //DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
