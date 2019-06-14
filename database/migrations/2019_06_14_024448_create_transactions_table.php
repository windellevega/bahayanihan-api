<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('hailer_id');
            $table->foreign('hailer_id')
                ->references('id')
                ->on('users');
            $table->unsignedBigInteger('worker_id');
            $table->foreign('worker_id')
                ->references('id')
                ->on('users');
            $table->unsignedBigInteger('skill_id');
            $table->foreign('skill_id')
                ->references('id')
                ->on('skills');
            $table->string('job_description');
            $table->string('trasaction_long');
            $table->string('transaction_lat');
            $table->string('actions_taken');
            $table->unsignedBigInteger('job_durations');
            $table->decimal('total_cost');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
