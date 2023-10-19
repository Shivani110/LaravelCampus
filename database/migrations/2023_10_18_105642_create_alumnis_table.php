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
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('about_me');
            $table->string('pictures');
            $table->string('school');
            $table->string('social_link');
            $table->string('profession');
            $table->string('company');
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
        Schema::dropIfExists('alumnis');
    }
};
