<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->nullable()->default(null);
            $table->string("title")->nullable()->default(null);
            $table->string("slug")->nullable()->default(null);
            $table->integer("views")->nullable()->default(null);
            $table->string("image")->nullable()->default(null);
            $table->longText("body")->nullable()->default(null);
            $table->boolean("published")->nullable()->default(null);
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
        Schema::dropIfExists('posts');
    }
}
