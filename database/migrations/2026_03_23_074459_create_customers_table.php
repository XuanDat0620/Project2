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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('cus_id');
            $table->string('cus_name');
            $table->string('cus_phone')->nullable();
            $table->enum('cus_gender', ['male', 'female', 'other'])->nullable();
            $table->string('cus_address')->nullable();
            $table->string('cus_email')->unique();
            $table->string('cus_password');
            $table->date('cus_dob')->nullable();
            $table->enum('cus_status', ['active', 'inactive'])->default('active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
