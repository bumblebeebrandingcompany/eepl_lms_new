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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('aadhar_no');
            $table->string('pan');
            $table->string('phone');
            $table->string('secondary_phone')->nullable();
            $table->string('email');
            $table->string('secondary_email')->nullable();
            $table->integer('payment_mode');
            $table->string('plc_values');
            $table->string('total_amount');
            $table->string('advance_amount')->nullable();
            $table->string('pending_amount')->nullable();
            $table->string('discount_value_sqft_based')->nullable();
            $table->string('discount_amount_sqft_based')->nullable();
            $table->string('discount_value_including_plc')->nullable();
            $table->string('discount_amount_including_plc')->nullable();
            $table->string('cheque_no');
            $table->boolean('credit/not_credit')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_no')->nullable();
            $table->date('cheque_date')->nullable();
            $table->string('dd_name')->nullable();
            $table->string('dd_no')->nullable();
            $table->date('dd_date')->nullable();
            $table->string('dd_bank')->nullable();
            $table->json('plot_id');
            $table->date('final_rate');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
