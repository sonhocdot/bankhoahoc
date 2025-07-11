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
        Schema::create('advices', function (Blueprint $table) {
            $table->id(); // int unsigned trong hình, dùng id() cho chuẩn Laravel
            $table->text('thong_tin')->nullable(); // varchar(1000) -> text() hoặc longText() tùy độ dài dự kiến
            $table->string('tinh_thanh', 50)->nullable();
            $table->string('ho_ten', 100)->nullable();
            $table->string('phone', 50)->nullable();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete(); // Ràng buộc khóa ngoại
            // Không có timestamps trong hình ảnh
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advice');
    }
};
