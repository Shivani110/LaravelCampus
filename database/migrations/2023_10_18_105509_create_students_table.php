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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('about_me');
            $table->string('pictures');
            $table->string('college_name');
            $table->string('location');
            $table->string('course');
            $table->string('level');
            $table->string('state_of_origin');
            $table->string('authenticate_student');
            $table->string('social_link');
            $table->string('mailbox');
            $table->string('calendar');
            $table->string('political_position');
            $table->string('review');
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
        Schema::dropIfExists('students');
    }
};
