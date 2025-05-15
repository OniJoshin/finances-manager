<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('recurring_income_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recurring_income_id')->constrained()->onDelete('cascade');
            $table->foreignId('income_id')->constrained()->onDelete('cascade');
            $table->date('generated_for_date'); // the received_at value
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurring_income_logs');
    }
};
