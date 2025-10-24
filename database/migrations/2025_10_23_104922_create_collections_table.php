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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id')->constrained()->cascadeOnDelete();
            $table->foreignId('collector_id')->constrained('users')->cascadeOnDelete(); // المحصل
            $table->date('collection_date'); // تاريخ التحصيل
            $table->decimal('amount', 10, 2); // المبلغ المحصل
            $table->string('collection_receipt')->nullable(); // صورة التحويل من العميل
            $table->decimal('tanfeed_fee', 10, 2)->nullable(); // نسبة تنفيذ تك
            $table->string('tanfeed_receipt')->nullable(); // صورة تحويل النسبة من التاجر
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
