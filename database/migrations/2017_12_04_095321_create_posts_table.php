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
            $table->string('title')->unique();
            $table->text('body');
			//app min 60minutes, app max 525600minutes = 1 year, field max 16777215 minutes => 31.9 years 
			$table->unsignedMediumInteger('ttl');
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
