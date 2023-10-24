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
        Schema::create('college_templates', function (Blueprint $table) {
            $table->id();
            $table->string('template_title');
            $table->string('slug');
            $table->string('logo');
            $table->string('first_section_title');
            $table->text('first_section_description');
            $table->string('first_section_background_img');
            $table->string('first_section_button_text');
            $table->text('second_section_left_textarea');
            $table->string('second_section_right_image');
            $table->string('third_section_title');
            $table->string('third_section_subtitle');
            $table->string('third_section_image');
            $table->string('third_section_image_txt');
            $table->string('third_section_button_txt');
            $table->string('fourth_section_title');
            $table->text('fourth_section_description');
            $table->string('fourth_section_button_txt');
            $table->string('fourth_section_background_img');
            $table->string('fifth_section_title');
            $table->string('fifth_section_subtitle');
            $table->text('fifth_section_textarea');
            $table->text('last_section_textarea');
            $table->string('last_section_fb_link');
            $table->string('last_section_twitter_link');
            $table->string('last_section_instagram_link');
            $table->string('last_section_linkedin_link');
            $table->integer('clg_id');
            $table->integer('affilated_by');
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
        Schema::dropIfExists('college_templates');
    }
};
