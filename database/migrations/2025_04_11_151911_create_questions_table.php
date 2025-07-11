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
        Schema::create('questions', function (Blueprint $table) {
            $table->id(); // int -> id()
            $table->foreignId('id_quiz')->constrained('quizzes')->cascadeOnDelete();
            $table->string('question', 255);
            $table->string('option_a', 255)->nullable();
            $table->string('option_b', 255)->nullable();
            $table->string('option_c', 255)->nullable();
            $table->string('option_d', 255)->nullable();
            $table->char('correct_option', 1)->nullable(); // 'a', 'b', 'c', 'd'
             // Không có timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
