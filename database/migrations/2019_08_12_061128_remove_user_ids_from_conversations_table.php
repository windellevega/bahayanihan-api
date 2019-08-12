<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUserIdsFromConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropForeign(['user_one_id']);
            $table->dropColumn('user_one_id');
            $table->dropForeign(['user_two_id']);
            $table->dropColumn('user_two_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->unsignedBigInteger('user_one_id');
            $table->foreign('user_one_id')
                ->references('id')
                ->on('users');
            $table->unsignedBigInteger('user_two_id');
            $table->foreign('user_two_id')
                ->references('id')
                ->on('users');
        });
    }
}
