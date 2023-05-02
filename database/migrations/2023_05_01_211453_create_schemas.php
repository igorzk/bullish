<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE SCHEMA entities;");
        DB::statement("CREATE SCHEMA accounts;");
        DB::statement("CREATE SCHEMA events;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP SCHEMA IF EXISTS events;");
        DB::statement("DROP SCHEMA IF EXISTS accounts;");
        DB::statement("DROP SCHEMA IF EXISTS entities;");
    }
};
