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
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('participant_id')->change()->constrained()->cascadeOnDelete();
        });
        Schema::table('runner_kits', function (Blueprint $table) {
            $table->foreignId('participant_id')->change()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('participant_id')->change()->constrained();
        });
        Schema::table('runner_kits', function (Blueprint $table) {
            $table->foreignId('participant_id')->change()->constrained();
        });
    }
};
