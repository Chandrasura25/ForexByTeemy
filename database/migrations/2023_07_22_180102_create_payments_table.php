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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id');
            $table->string('status');
            $table->string('reference');
            $table->integer('amount');
            $table->string('channel');
            $table->string('currency');
            $table->unsignedBigInteger('user_id');
            $table->string('email');
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
