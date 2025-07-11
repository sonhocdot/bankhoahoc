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
        Schema::create('lesson_relationships', function (Blueprint $table) {
            // int -> foreignId
            $table->foreignId('id_course')->constrained('courses')->cascadeOnDelete();
            $table->foreignId('id_lesson')->constrained('lessons')->cascadeOnDelete();
            // Không có timestamps

            $table->primary(['id_course', 'id_lesson']); // Khóa chính phức hợp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_relationships');
    }
};
