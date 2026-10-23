<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_ki', function (Blueprint $table) {
            $table->string('nomor_kontak', 25)->nullable()->after('pemilik');
            $table->string('bukti_pendukung')->nullable()->after('keterangan');
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_ki', function (Blueprint $table) {
            $table->dropColumn(['nomor_kontak', 'bukti_pendukung']);
        });
    }
};
