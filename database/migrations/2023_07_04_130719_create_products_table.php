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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('product_type_id');
            $table->integer('quantity');
            $table->integer('price');
            $table->text('description')->nullable();
            $table->integer('commission')->nullable();
            $table->integer('super_affiliate_commission')->nullable();
            $table->timestamp('expiration_date')->nullable();
            $table->timestamps();

            $table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
