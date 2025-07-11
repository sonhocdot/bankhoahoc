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
        Schema::create('favorite_courses', function (Blueprint $table) {
            // Không có id chính trong hình, dùng khóa ngoại làm khóa chính phức hợp
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->foreignId('id_course')->constrained('courses')->cascadeOnDelete();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            // Khóa chính phức hợp
            $table->primary(['id_user', 'id_course']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorite_courses');
    }
};
