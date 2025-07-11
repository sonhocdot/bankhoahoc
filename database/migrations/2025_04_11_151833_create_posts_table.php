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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // int unsigned -> id()
            $table->foreignId('post_author')->constrained('users')->cascadeOnDelete();
            $table->string('post_title', 150);
            $table->longText('post_content')->nullable();
            $table->string('slug', 150)->unique()->nullable();
            $table->string('post_image', 1000)->nullable(); // URL hoặc path
            $table->dateTime('post_date')->nullable(); // datetime trong hình
            $table->integer('comment_count')->default(0);
            $table->integer('post_view')->default(0);
            $table->text('description')->nullable();
            $table->foreignId('category')->constrained('post_categories')->cascadeOnDelete();
             // Không có created_at/updated_at trong hình, chỉ có post_date
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
