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
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // int unsigned -> id()
            $table->foreignId('id_author')->constrained('users')->cascadeOnDelete();
            $table->string('name', 255);
            $table->string('img', 255)->nullable(); // URL hoặc path ảnh
            $table->text('description')->nullable(); // varchar(1000) -> text()
            $table->longText('content')->nullable();
            $table->integer('view_count')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('slug', 255)->unique()->nullable();
            $table->integer('gia_goc')->nullable();
            $table->integer('gia_giam')->nullable();
            $table->foreignId('category')->constrained('course_categories')->cascadeOnDelete();
            $table->tinyInteger('average_rate')->nullable()->default(0); // tinyint(1) có thể là 0-5 sao? Dùng tinyInteger
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
