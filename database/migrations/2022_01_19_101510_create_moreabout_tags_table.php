<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoreaboutTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moreabout_tags', function (Blueprint $table) {
            $table->integer('moreabout_id')->unsigned();
            $table->foreign('moreabout_id')
                ->references('id')
                ->on('more_abouts')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onUpdate('cascade')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moreabout_tags');
    }
}
