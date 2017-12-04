<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('creator')->unsigned();
            $table->integer('topic')->unsigned();
            $table->string('title');
            $table->text('body');
            $table->timestamp('ttl')->nullable();
            $table->timestamps();
            
            $table->foreign('creator')
                  ->references('id')->on('users');
            
            $table->foreign('topic')
                  ->references('id')->on('topics');
                    
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
