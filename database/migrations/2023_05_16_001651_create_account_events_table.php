<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('events.account_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custody_account_id')->constrained();
            $table->date('transaction_date');
            $table->date('settlement_date');
            $table->string('type');
            $table->jsonb('body');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events.account_events');
    }
};
