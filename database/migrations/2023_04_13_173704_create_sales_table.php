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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('lister_id');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('team_type_history_id');
            $table->string('type');
            $table->integer('amount');
            $table->integer('commission');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('lister_id')->references('id')->on('users');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('team_type_history_id')->references('id')->on('team_type_histories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
