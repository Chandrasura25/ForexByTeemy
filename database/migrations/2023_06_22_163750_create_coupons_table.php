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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code')->unique();
            $table->unsignedBigInteger('coupon_channel_id')->nullable();
            $table->enum('coupon_type',['percentage','fixed']);
            $table->string('discount');
            $table->enum('effectivity', ['first purchases', 'forever']);
            $table->string('description');
            $table->string('status')->default('active');
            $table->string('username');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
            
            $table->foreign('coupon_channel_id')->references('id')->on('coupon_channels')->onDelete('cascade');
            $table->foreign('username')->references('username')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
