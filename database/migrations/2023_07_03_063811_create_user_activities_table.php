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
        // Schema::create('user_activities', function (Blueprint $table) {
        //     $table->id();
        //     $table->bigInteger('user_id')->unsigned()->index()->nullable();
        //     $table->foreign('user_id')->references('id')->on('users');
        //     $table->bigInteger('activity_type_id')->unsigned()->index()->nullable();
        //     $table->foreign('activity_type_id')->references('id')->on('activity_types');
        //     $table->longText('activity');
        //     $table->float('previous_balance', 9);
        //     $table->float('current_balance', 9);
        //     $table->float('transaction_amount', 9);
        //     $table->timestamps();
        // });
        Schema::dropIfExists('user_activities');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
};
