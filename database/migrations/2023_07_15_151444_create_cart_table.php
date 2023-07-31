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
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->integer('quantity');
            $table->boolean('is_purchased')->default(false);
            $table->integer('total_price');
            $table->string('coupon_code')->nullable();
            $table->timestamps();
            
            // Define foreign keys
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->cascadeOnDelete();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->cascadeOnDelete();
            $table->foreign('coupon_code')->references('coupon_code')->on('coupons')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
