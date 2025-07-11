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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id(); // int -> id()
            $table->string('title', 255);
            $table->foreignId('id_author')->constrained('users')->cascadeOnDelete();
            $table->integer('duration')->nullable(); // Đơn vị? phút? giây?
            $table->string('description', 255)->nullable();
            $table->dateTime('created_at')->nullable(); // datetime trong hình
            $table->dateTime('updated_at')->nullable(); // datetime trong hình
            $table->foreignId('category')->constrained('course_categories')->cascadeOnDelete(); // Giả sử quiz cũng thuộc course category
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
