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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // unsignedBigInteger 'id', primary, auto-increment
            $table->string('username', 150)->unique();
            $table->string('display_name', 150)->nullable();
            $table->string('email', 150)->unique();
            $table->string('phone', 45)->nullable();
            $table->string('password', 150); // Laravel tự hash, độ dài mặc định thường đủ
            $table->string('role', 45)->default('user'); // Giả sử có role, mặc định là 'user'
            $table->string('avatar', 1000)->nullable();
            // $table->timestamp('email_verified_at')->nullable(); // Nên có trong ứng dụng thực tế
            // $table->rememberToken(); // Nên có cho chức năng "Remember Me"
            $table->timestamp('created_at')->nullable(); // Theo hình ảnh là timestamp
            $table->timestamp('updated_at')->nullable(); // Theo hình ảnh là timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
