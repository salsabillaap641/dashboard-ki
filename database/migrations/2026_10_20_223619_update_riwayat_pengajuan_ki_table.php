<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('riwayat_pengajuan_ki', function (Blueprint $table) {
            $table->dropForeign(['data_ki_id']);
            $table->dropColumn('data_ki_id');
        });

        Schema::table('riwayat_pengajuan_ki', function (Blueprint $table) {
            $table->unsignedBigInteger('pengajuan_ki_id');

            $table->foreign('pengajuan_ki_id')
                ->references('id')
                ->on('pengajuan_ki')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('riwayat_pengajuan_ki', function (Blueprint $table) {
            $table->dropForeign(['pengajuan_ki_id']);
            $table->dropColumn('pengajuan_ki_id');
        });

        Schema::table('riwayat_pengajuan_ki', function (Blueprint $table) {
            $table->integer('data_ki_id');

            $table->foreign('data_ki_id')
                ->references('id')
                ->on('data_ki')
                ->cascadeOnDelete();
        });
    }
};
