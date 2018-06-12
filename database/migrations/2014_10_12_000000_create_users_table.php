<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name','50');
            $table->string('family','50');
            $table->string('national_code','12');
            $table->string('gender','5');
            $table->date('birth_date');
            $table->string('username','90');
            $table->string('password','255');
            $table->string('cell_phone','12');
            $table->string('email','40')->unique();
            $table->date('created_at_shamsi');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
