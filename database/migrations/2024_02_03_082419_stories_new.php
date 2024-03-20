<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id('id_role');
            $table->string('role');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_role');
            $table->foreign('id_role')->references('id_role')->on('roles');
            $table->string('image_user');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('phone_number')->nullable();
            $table->integer('active')->nullable();
            $table->timestamps();
        });
        Schema::create('requestWriter', function (Blueprint $table) {
            $table->id('id_request');
            $table->unsignedBigInteger('id_role');
            $table->foreign('id_role')->references('id_role')->on('roles');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users');
            $table->integer('status_approve');
            $table->timestamps();
        });

        Schema::create('company', function (Blueprint $table) {
            $table->id('id_company');
            $table->string('company_name');
            $table->string('contact');
            $table->string('faq');
            $table->string('about_us');
            $table->string('term');
            $table->string('privacy');
            $table->timestamps();
        });

        Schema::create('genre', function (Blueprint $table) {
            $table->id('id_genre');
            $table->string('genre');
            $table->timestamps();
        });
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('id_notification');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->string('message');
            $table->string('type');
            $table->integer('is_read');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id('id_category');
            $table->string('category');
            $table->timestamps();
        });
        Schema::create('stories', function (Blueprint $table) {
            $table->id('id_story');
            $table->unsignedBigInteger('id_genre');
            $table->foreign('id_genre')->references('id_genre')->on('genre');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_category');
            $table->foreign('id_category')->references('id_category')->on('categories');
            $table->string('title');
            $table->string('images');
            $table->text('sinopsis');
            $table->string('book_status');
            $table->timestamps();
        });
        Schema::create('comments', function (Blueprint $table) {
            $table->id('id_comment');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_story');
            $table->foreign('id_story')->references('id_story')->on('stories');
            $table->string('comment');
            $table->timestamps();
        });
        Schema::create('favorites', function (Blueprint $table) {
            $table->id('id_favorite');
            $table->unsignedBigInteger('id_story');
            $table->foreign('id_story')->references('id_story')->on('stories');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->integer('favorit');
            $table->timestamps();
        });

        Schema::create('rates', function (Blueprint $table) {
            $table->id('id_rate');
            $table->unsignedBigInteger('id_story');
            $table->foreign('id_story')->references('id_story')->on('stories');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->integer('rate');
            $table->integer('status');
            $table->timestamps();
        });

        Schema::create('chapters', function (Blueprint $table) {
            $table->id('id_chapter');
            $table->unsignedBigInteger('id_story');
            $table->foreign('id_story')->references('id_story')->on('stories');
            $table->string('chapter');
            $table->timestamps();
        });

        Schema::create('characters', function (Blueprint $table) {
            $table->id('id_character');
            $table->unsignedBigInteger('id_story');
            $table->foreign('id_story')->references('id_story')->on('stories');
            $table->unsignedBigInteger('id_chapter');
            $table->foreign('id_chapter')->references('id_chapter')->on('chapters');
            $table->string('character');
            $table->timestamps();
        });

        Schema::create('dialogs', function (Blueprint $table) {
            $table->id('id_dialog');
            $table->unsignedBigInteger('id_story');
            $table->foreign('id_story')->references('id_story')->on('stories');
            $table->unsignedBigInteger('id_chapter');
            $table->foreign('id_chapter')->references('id_chapter')->on('chapters');
            $table->unsignedBigInteger('id_character');
            $table->foreign('id_character')->references('id_character')->on('characters');
            $table->string('dialog');
            $table->timestamps();
        });
        Schema::create('boorkmarks', function (Blueprint $table) {
            $table->id('id_boorkmark');
            $table->unsignedBigInteger('id_chapter');
            $table->foreign('id_chapter')->references('id_chapter')->on('chapters');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
        });


        Schema::create('faqs', function (Blueprint $table) {
            $table->id('id_faq');
            $table->unsignedBigInteger('faq');
            $table->timestamps();
        });

        Schema::create('contact', function (Blueprint $table) {
            $table->id('id_contact');
            $table->string('email_company');
            $table->string('phone_company');
            $table->string('social_media');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dialogs');
        Schema::dropIfExists('characters');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('chapters');
        Schema::dropIfExists('rates');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('stories');
        Schema::dropIfExists('genre');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('boorkmarks');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('contact');
        Schema::dropIfExists('company');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('requestWriter');
    }
};
