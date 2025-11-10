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
        Schema::create('complaint_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id')
                ->constrained('complaints')
                ->onDelete('cascade'); // if complaint deleted, attachments also deleted
            $table->string('file_name'); // actual filename (e.g. contract1.pdf)
            $table->string('display_name')->nullable(); // optional title (e.g. عقد العميل)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_attachments');
    }
};
