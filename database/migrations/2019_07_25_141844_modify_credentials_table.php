<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credentials', function (Blueprint $table) {
            $table->dropForeign(['user_skill_id']);
            $table->dropColumn('user_skill_id');
            $table->unsignedBigInteger('user_id')
                    ->after('id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credentials', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->unsignedBigInteger('user_skill_id')
                    ->after('id');
            $table->foreign('user_skill_id')
                ->references('id')
                ->on('user_skills');
        });
    }
}
