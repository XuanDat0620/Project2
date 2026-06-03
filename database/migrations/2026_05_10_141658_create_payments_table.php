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
            $table->id('pay_id');
            $table->unsignedBigInteger('ord_id');
            $table->unsignedBigInteger('pm_id');
            $table->decimal('pay_amount', 10, 2);
            $table->enum('pay_status', [
                'pending',
                'paid',
                'failed'
            ])->default('pending');
            $table->string('pay_transaction_code')->nullable();
            $table->dateTime('pay_date')->nullable();
            $table->timestamps();
            $table->foreign('ord_id')->references('ord_id')->on('orders')->onDelete('cascade');
            $table->foreign('pm_id')->references('pm_id')->on('payment_methods');
            $table->unique('ord_id');
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
