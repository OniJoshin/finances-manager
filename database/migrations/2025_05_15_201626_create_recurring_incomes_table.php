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
        Schema::create('recurring_incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('source');
            $table->decimal('amount', 10, 2);
            $table->enum('frequency', ['weekly', 'monthly']);
            $table->date('start_date');
            $table->unsignedTinyInteger('day_of_month')->nullable(); // set by user or extracted from start_date
            $table->text('notes')->nullable();
            $table->date('last_generated_at')->nullable(); // tracks most recent entry
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurring_incomes');
    }
};
