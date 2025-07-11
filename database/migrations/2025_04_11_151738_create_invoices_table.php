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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id(); // int trong hình, dùng id() cho chuẩn
            $table->string('ho_ten', 255)->nullable();
            $table->integer('gia_goc')->nullable();
            $table->integer('gia_giam')->nullable();
            $table->text('ghi_chu')->nullable(); // varchar(1000) -> text()
            $table->string('trang_thai', 45)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('so_dien_thoai', 45)->nullable();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
