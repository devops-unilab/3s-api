<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->timestamps();
            $table->bigInteger('id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('login')->nullable();
            $table->string('password')->nullable();
            $table->string('role')->nullable();
            $table->bigInteger('division_id')->nullable();
            $table->string('division_sig')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
