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
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id')->constrained()->cascadeOnDelete();
            $table->foreignId('collector_id')->constrained('users')->cascadeOnDelete(); // المحصل
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // المحامي
            $table->text('note'); // ملاحظات أو تفاصيل المتابعة
            $table->string('method')->nullable(); // وسيلة المتابعة (هاتف - زيارة - بريد ...)
            $table->date('follow_date')->nullable(); // تاريخ المتابعة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow_ups');
    }
};
