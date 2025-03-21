<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Remove FK existente
            $table->dropForeign(['participant_id']);

            // Adiciona FK com onDelete('cascade')
            $table->foreign('participant_id')
                ->references('id')
                ->on('participants')
                ->onDelete('cascade');
        });

        Schema::table('runner_kits', function (Blueprint $table) {
            // Remove FK existente
            $table->dropForeign(['participant_id']);

            // Adiciona FK com onDelete('cascade')
            $table->foreign('participant_id')
                ->references('id')
                ->on('participants')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['participant_id']);
            $table->foreign('participant_id')
                ->references('id')
                ->on('participants');
        });

        Schema::table('runner_kits', function (Blueprint $table) {
            $table->dropForeign(['participant_id']);
            $table->foreign('participant_id')
                ->references('id')
                ->on('participants');
        });
    }
};
