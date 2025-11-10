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
        Schema::table('collections', function (Blueprint $table) {
            $table->decimal('collector_fee', 10, 2)->nullable()->after('tanfeed_receipt');
            $table->string('collector_fee_receipt')->nullable()->after('collector_fee');
        });
    }

    public function down(): void
    {
        Schema::table('collections', function (Blueprint $table) {
            $table->dropColumn(['collector_fee', 'collector_fee_receipt']);
        });
    }
};
