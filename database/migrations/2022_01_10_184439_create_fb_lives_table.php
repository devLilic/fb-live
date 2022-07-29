<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFbLivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_lives', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->text('embed_url');
            $table->string('stream_key');
            $table->unsignedBigInteger('page_id');
            $table->string('title');
            $table->boolean('is_live')->default(false);
            $table->timestamps();

            $table->primary('id');
            $table->foreign('page_id')->references('id')->on('fb_pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fb_lives');
    }
}
