<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFbPagesFbUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_pages_fb_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fb_page_id');
            $table->unsignedBigInteger('fb_user_id');
            $table->text('page_access_token')->nullable();
            $table->timestamps();

            $table->foreign('fb_page_id')->references('id')->on('fb_pages');
            $table->foreign('fb_user_id')->references('id')->on('fb_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fb_pages_fb_users');
    }
}
