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
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('division_id')->nullable()->change();
            $table->unsignedBigInteger('service_id')->nullable()->change();
            $table->unsignedBigInteger('client_user_id')->nullable()->change();
            $table->unsignedBigInteger('provider_user_id')->nullable()->change();
            $table->unsignedBigInteger('assigned_user_id')->nullable()->change();
            $table->string('status', 255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('division_id')->nullable()->change();
            $table->unsignedInteger('service_id')->nullable()->change();
            $table->unsignedInteger('client_user_id')->nullable()->change();
            $table->unsignedInteger('provider_user_id')->nullable()->change();
            $table->unsignedInteger('assigned_user_id')->nullable()->change();
            $table->string('status', 1)->change();

        });
    }
};
