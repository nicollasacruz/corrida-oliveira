<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $timestamp = now();

        DB::table('events')
            ->whereRaw('lower(name) like ?', ['%femin%'])
            ->update([
                'image' => 'events/homepage/trail-feminino.jpeg',
                'updated_at' => $timestamp,
            ]);

        DB::table('events')
            ->whereRaw('lower(name) like ?', ['%mascul%'])
            ->update([
                'image' => 'events/homepage/trail-masculino.jpeg',
                'updated_at' => $timestamp,
            ]);

        DB::table('events')
            ->whereRaw('lower(name) like ?', ['%caminhada%'])
            ->where('isChildEvent', true)
            ->update([
                'image' => 'events/homepage/caminhada-infantil.jpeg',
                'updated_at' => $timestamp,
            ]);

        DB::table('events')
            ->whereRaw('lower(name) like ?', ['%caminhada%'])
            ->where('isChildEvent', false)
            ->update([
                'image' => 'events/homepage/caminhada-adulto.jpeg',
                'updated_at' => $timestamp,
            ]);
    }

    public function down(): void
    {
        DB::table('events')
            ->whereIn('image', [
                'events/homepage/trail-feminino.jpeg',
                'events/homepage/trail-masculino.jpeg',
                'events/homepage/caminhada-infantil.jpeg',
                'events/homepage/caminhada-adulto.jpeg',
            ])
            ->update([
                'image' => null,
                'updated_at' => now(),
            ]);
    }
};
