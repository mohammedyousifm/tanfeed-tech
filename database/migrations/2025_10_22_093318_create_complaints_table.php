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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();

            // Main references
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // التاجر / المستخدم صاحب الفاتورة

            // Multiple collectors (store as JSON array)
            $table->json('collector_ids')->nullable(); // e.g. [1, 3, 5]

            // Client information
            $table->string('client_name');
            $table->string('client_national_id')->nullable();
            $table->string('commercial_name')->nullable();
            $table->string('commercial_record_number')->nullable();

            // Contract & financial details
            $table->string('contract_number')->nullable();
            $table->decimal('amount_requested', 15, 2)->nullable();
            $table->decimal('amount_paid', 15, 2)->default(0);
            $table->decimal('amount_remaining', 15, 2)->nullable();
            $table->string('service_requested')->nullable();
            $table->string('contract_attachments')->nullable(); // path to uploaded files

            // Status tracking
            $table->enum('status', ['new', 'pending', 'in_progress', 'completed', 'cancelled'])->default('new');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
