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
            $table->id('p_id');
            $table->unsignedBigInteger('cate_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('p_name');
            $table->string('p_image')->nullable();
            $table->text('p_desc')->nullable();
            $table->enum('p_status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->foreign('cate_id')->references('cate_id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('brand_id')->on('brands')->onDelete('cascade');
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
