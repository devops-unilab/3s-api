<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->change();
            $table->unsignedBigInteger('division_id')->change()->nullable();
            $table->string('name', 255)->change()->nullable();
            $table->string('email', 255)->change()->nullable();
            $table->string('password', 255)->change()->nullable();
            $table->string('role', 255)->nullable()->change()->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            $table->unsignedInteger('id')->change();
            $table->unsignedInteger('division_id')->nullable()->change()->nullable();
            $table->char('name', 255)->change()->nullable();
            $table->char('email', 255)->change()->nullable();
            $table->char('password', 255)->change()->nullable();
            $table->char('role', 1)->nullable()->change()->nullable();

        });
    }
};
