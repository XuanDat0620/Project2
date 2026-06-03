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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id('pv_id');
            $table->unsignedBigInteger('p_id');
            $table->unsignedBigInteger('size_id');
            $table->unsignedBigInteger('color_id');
            $table->decimal('pv_price', 10, 2);
            $table->integer('pv_stock')->default(0);
            $table->string('pv_image')->nullable();
            $table->enum('pv_status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->foreign('p_id')->references('p_id')->on('products')->onDelete('cascade');
            $table->foreign('size_id')->references('size_id')->on('sizes');
            $table->foreign('color_id')->references('color_id')->on('colors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
