<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_ki', function (Blueprint $table) {
            if (!Schema::hasColumn('data_ki', 'nomor_kontak')) {
                $table->string('nomor_kontak', 25)->nullable();
            }
            if (!Schema::hasColumn('data_ki', 'bukti_pendukung')) {
                $table->string('bukti_pendukung')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('data_ki', function (Blueprint $table) {
            $columns = [];
            if (Schema::hasColumn('data_ki', 'nomor_kontak')) $columns[] = 'nomor_kontak';
            if (Schema::hasColumn('data_ki', 'bukti_pendukung')) $columns[] = 'bukti_pendukung';
            if ($columns) $table->dropColumn($columns);
        });
    }
};
