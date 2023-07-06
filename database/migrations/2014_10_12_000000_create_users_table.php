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
        Schema::create('users', function (Blueprint $table) { 
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('bio')->nullable();
            $table->string('number')->nullable();
            $table->string('referrer')->nullable();
            $table->string('ref_source')->nullable();
            $table->string('credits')->default(0);
            $table->string('referral_link')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('profile_pic')->nullable(); 
            $table->string('discount')->nullable();
            $table->string('coupons')->nullable();
            $table->integer('personal_coupon')->default(0);
            $table->integer('coupon_percent')->nullable();
            $table->string('effectivity')->nullable(); 
            $table->timestamp('last_activity')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
