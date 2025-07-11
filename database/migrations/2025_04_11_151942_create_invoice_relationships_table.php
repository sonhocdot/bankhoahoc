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
        Schema::create('invoice_relationships', function (Blueprint $table) {
            // int -> foreignId
            $table->foreignId('id_invoice')->constrained('invoices')->cascadeOnDelete();
            $table->foreignId('id_course')->constrained('courses')->cascadeOnDelete();
            // Không có timestamps

            $table->primary(['id_invoice', 'id_course']); // Khóa chính phức hợp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_relationships');
    }
};
