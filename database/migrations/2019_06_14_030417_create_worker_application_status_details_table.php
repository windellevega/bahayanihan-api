<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerApplicationStatusDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_application_status_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('worker_application_id');
            $table->foreign('worker_application_id')
                ->references('id')
                ->on('worker_applications');
            $table->unsignedBigInteger('application_status_id');
            $table->foreign('application_status_id')
                ->references('id')
                ->on('application_statuses');
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
        Schema::dropIfExists('worker_application_status_details');
    }
}
