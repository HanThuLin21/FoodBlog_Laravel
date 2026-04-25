<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbladmin', function (Blueprint $table) {
            $table->id('admin_id');
            $table->string('admin_name', 225);
            $table->string('admin_email', 225);
            $table->string('admin_pass', 225);
            $table->string('admin_conpass', 225);
        });

        Schema::create('user', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_name', 225);
            $table->string('user_email', 225);
            $table->string('user_phone', 225);
            $table->string('user_pass', 225);
            $table->string('user_conpass', 225);
        });

        Schema::create('blogpost', function (Blueprint $table) {
            $table->id('post_id');
            $table->string('post_title', 225);
            $table->string('post_category', 225);
            $table->string('foodtype', 225);
            $table->text('post_description');
            $table->text('post_image');
            $table->text('post_image2');
            $table->dateTime('post_date');
        });

        Schema::create('recipe', function (Blueprint $table) {
            $table->id('recipe_id');
            $table->string('recipe_name', 225);
            $table->string('recipe_category', 225);
            $table->string('foodtype', 225);
            $table->text('image1');
            $table->text('image2');
            $table->text('image3');
            $table->text('recipe_content');
            $table->string('prep_time', 225);
            $table->string('cook_time', 225);
            $table->integer('servings');
            $table->longText('instructions');
        });

        Schema::create('restaurant', function (Blueprint $table) {
            $table->id('restaurant_id');
            $table->string('restaurant_name', 225);
            $table->string('restaurant_phone', 225);
            $table->string('foodtype', 225);
            $table->text('restaurant_location');
            $table->text('restaurant_content');
            $table->text('restaurant_image');
            $table->text('restaurant_image2');
            $table->text('restaurant_image3');
            $table->string('restaurant_rating', 225);
            $table->string('opening_day', 225);
            $table->string('open_hour', 225);
            $table->string('close_hour', 225);
        });

        Schema::create('comment', function (Blueprint $table) {
            $table->id('comment_id');
            $table->integer('post_id')->index();
            $table->integer('user_id')->index();
            $table->text('comment_text');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment');
        Schema::dropIfExists('restaurant');
        Schema::dropIfExists('recipe');
        Schema::dropIfExists('blogpost');
        Schema::dropIfExists('user');
        Schema::dropIfExists('tbladmin');
    }
};
