<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoreAboutTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('more_about_tags', function (Blueprint $table) {
            $table->integer('more_about_id')->unsigned();
            $table->foreign('more_about_id')
                    ->references('id')
                    ->on('more_abouts')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('tag_id')->unsigned(); 
            $table->foreign('tag_id')
                    ->references('id')
                    ->on('tags')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');                               
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
        Schema::dropIfExists('more_about_tags');
    }
}
