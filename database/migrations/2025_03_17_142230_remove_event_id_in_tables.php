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
        Schema::table('runner_kits', function (Blueprint $table) {
            $table->foreignId('participant_id')->constrained();
            $table->string('size');
            $table->string('status')->default('pending');
            $table->dateTime('deliveredDate')->nullable();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropColumn('event_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('runner_kits', function (Blueprint $table) {
            $table->dropForeign(['participant_id']);
            $table->dropColumn('participant_id');
            $table->dropColumn('size');
            $table->dropColumn('status');
            $table->dropColumn('deliveredDate');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained();
        });
    }
};
