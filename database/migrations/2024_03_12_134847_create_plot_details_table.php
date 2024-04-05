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
        Schema::create('plot_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('plot_no');
            $table->string('plot_type');
            $table->string('dimension_length');
            $table->string('dimension_breadth');
            $table->bigInteger('total_sqfts');
            $table->bigInteger('price_id /persqfts');
            $table->string('overall_sqft_price');
            $table->json('plc values');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plot_details');
    }
};
