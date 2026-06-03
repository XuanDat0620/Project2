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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('ord_id');
            $table->unsignedBigInteger('cus_id');
            $table->unsignedBigInteger('u_id')->nullable();
            $table->string('ord_code')->unique();
            $table->string('ord_receiver_name');
            $table->string('ord_receiver_phone');
            $table->string('ord_receiver_address');
            $table->decimal('ord_total_price', 10, 2);
            $table->dateTime('ord_buy_date');
            $table->decimal('ord_shipping_fee', 10, 2)->default(0);
            $table->string('ord_shipping_method')->nullable();
            $table->dateTime('ord_shipping_date')->nullable();
            $table->text('ord_note')->nullable();
            $table->enum('ord_status', [
                'pending',
                'confirmed',
                'packing',
                'shipping',
                'delivered',
                'completed',
                'cancelled'
            ])->default('pending');
            $table->timestamps();
            $table->foreign('cus_id')->references('cus_id')->on('customers')->onDelete('cascade');
            $table->foreign('u_id')->references('u_id') ->on('users') ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
