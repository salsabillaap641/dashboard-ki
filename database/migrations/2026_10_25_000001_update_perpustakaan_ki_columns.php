<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus foreign key hanya jika memang terdaftar.
        $foreignKeys = DB::select("
            SELECT CONSTRAINT_NAME
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = 'perpustakaan_ki'
              AND REFERENCED_TABLE_NAME IS NOT NULL
        ");

        foreach ($foreignKeys as $foreignKey) {
            Schema::table('perpustakaan_ki', function (Blueprint $table) use ($foreignKey) {
                $table->dropForeign($foreignKey->CONSTRAINT_NAME);
            });
        }

        // Ganti nama kolom nomor_hak menjadi nomor_permohonan.
        if (
            Schema::hasColumn('perpustakaan_ki', 'nomor_hak') &&
            !Schema::hasColumn('perpustakaan_ki', 'nomor_permohonan')
        ) {
            Schema::table('perpustakaan_ki', function (Blueprint $table) {
                $table->renameColumn('nomor_hak', 'nomor_permohonan');
            });
        }

        // Hapus kolom yang tidak lagi digunakan.
        foreach (['data_ki_id', 'jenis_ki_id', 'kabupaten_id'] as $column) {
            if (Schema::hasColumn('perpustakaan_ki', $column)) {
                Schema::table('perpustakaan_ki', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }

    public function down(): void
    {
        // Rollback otomatis tidak memulihkan data kolom yang dihapus.
        // Pulihkan dari backup jika diperlukan.
        throw new RuntimeException(
            'Rollback migration ini tidak didukung karena kolom lama telah dihapus.'
        );
    }
};
