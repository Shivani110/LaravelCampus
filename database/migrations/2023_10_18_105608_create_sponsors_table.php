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
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('about_me')->nullable();
            $table->string('pictures')->nullable();
            $table->string('type_of_support')->nullable();
            $table->string('social_link')->nullable();
            $table->string('profession')->nullable();
            $table->string('company')>nullable();
            $table->string('mailbox')->nullable();
            $table->string('calendar')->nullable();
            $table->string('political_position')->nullable();
            $table->string('review')->nullable();
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
        Schema::dropIfExists('sponsors');
    }
};
