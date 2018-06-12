<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title','35');
            $table->string('brief','250');
            $table->string('page_address','50')->nullable();
            $table->integer('input_at');
            $table->text('definition')->nullable();
            $table->date('created_at');
            $table->date('Begin_at');
            $table->date('End_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content');
    }
}
