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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // int -> id()
            // Cho phép null nếu comment không thuộc về post HOẶC course (tùy logic)
            $table->foreignId('id_post')->nullable()->constrained('posts')->cascadeOnDelete();
            $table->foreignId('id_course')->nullable()->constrained('courses')->cascadeOnDelete();
            // Tham chiếu đến chính nó (comment cha), phải nullable
            $table->foreignId('id_parent')->nullable()->constrained('comments')->cascadeOnDelete();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->text('content')->nullable(); // varchar(1000) -> text()
            $table->integer('report_count')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->tinyInteger('rate')->nullable(); // Đánh giá sao?
            $table->boolean('show')->default(true); // tinyint(1) -> boolean (hiển thị/ẩn)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
