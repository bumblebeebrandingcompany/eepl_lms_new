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
        Schema::create('cpwalkinleads', function (Blueprint $table) {
            $table->id();
            $table->string('ref_num')
            ->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('source');
            $table->string('sub_source');
            $table->bigInteger('project_id');
            $table->bigInteger('sell_do_id');
            $table->bigInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpwalkinleads');
    }
};
