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
        // First, remove any duplicate nama_lapangan entries (keep the oldest one)
        $duplicates = \DB::table('lapangans')
            ->select('nama_lapangan', \DB::raw('COUNT(*) as count'))
            ->groupBy('nama_lapangan')
            ->having('count', '>', 1)
            ->get();

        foreach ($duplicates as $duplicate) {
            $lapangans = \DB::table('lapangans')
                ->where('nama_lapangan', $duplicate->nama_lapangan)
                ->orderBy('id')
                ->get();

            // Keep the first one, delete others
            for ($i = 1; $i < $lapangans->count(); $i++) {
                \DB::table('lapangans')->where('id', $lapangans[$i]->id)->delete();
            }
        }

        // Add unique constraint
        Schema::table('lapangans', function (Blueprint $table) {
            $table->unique('nama_lapangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lapangans', function (Blueprint $table) {
            $table->dropUnique(['nama_lapangan']);
        });
    }
};
