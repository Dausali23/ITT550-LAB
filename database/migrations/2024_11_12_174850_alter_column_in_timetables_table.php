<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timetables', function (Blueprint $table) {
            $table->foreign('subject_id') ->references('id')-> on ('subjects');
            $table->foreign('day_id') ->references('id')-> on ('days');
            $table->foreign('hall_id') ->references('id')-> on ('halls');
            $table->foreign('user_id') ->references('id')-> on ('users');
            $table->foreign('group_id') ->references('id')-> on ('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timetables', function (Blueprint $table) {
            //
        });
    }
};
