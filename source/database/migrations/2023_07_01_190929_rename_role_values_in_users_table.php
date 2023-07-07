<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
       /**
     * Run the migration.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')
            ->whereIn('role', ['a', 'c', 't'])
            ->update([
                'role' => DB::raw("CASE
                    WHEN role = 'a' THEN 'administrator'
                    WHEN role = 'c' THEN 'customer'
                    WHEN role = 't' THEN 'provider'
                END"),
            ]);
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')
            ->whereIn('role', ['administrator', 'customer', 'provider'])
            ->update([
                'role' => DB::raw("CASE
                    WHEN role = 'administrator' THEN 'a'
                    WHEN role = 'customer' THEN 'c'
                    WHEN role = 'provider' THEN 't'
                END"),
            ]);
    }
};
