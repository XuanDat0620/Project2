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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('ord_detail_id');
            $table->unsignedBigInteger('ord_id');
            $table->unsignedBigInteger('pv_id');
            $table->integer('ord_detail_quantity');
            $table->decimal('ord_detail_price', 10, 2);
            $table->timestamps();
            $table->unique(['ord_id', 'pv_id']);
            $table->foreign('ord_id')->references('ord_id')->on('orders')->onDelete('cascade');
            $table->foreign('pv_id')->references('pv_id')->on('product_variants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
