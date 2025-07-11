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
        Schema::create('pictures', function (Blueprint $table) {
            $table->id(); // int unsigned -> id()
            $table->string('picture_name', 255)->nullable();
            $table->foreignId('id_author')->constrained('users')->cascadeOnDelete();
            $table->string('picture_image', 1000)->nullable(); // url hoặc path
            $table->string('picture_type', 45)->nullable(); // ví dụ: 'avatar', 'course_thumbnail', 'post_image'
            // Không có timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pictures');
    }
};
