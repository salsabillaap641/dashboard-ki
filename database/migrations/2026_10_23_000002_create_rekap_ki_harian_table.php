<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekap_ki_harian', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_data')->index();

            // Samakan tipe dengan kolom id INT(11) pada tabel referensi.
            $table->integer('kabupaten_id');
            $table->integer('jenis_ki_id');

            $table->enum('status', ['terdaftar', 'proses']);
            $table->unsignedInteger('jumlah')->default(0);
            $table->timestamps();

            $table->foreign('kabupaten_id')
                ->references('id')->on('kabupaten')
                ->cascadeOnDelete();

            $table->foreign('jenis_ki_id')
                ->references('id')->on('jenis_ki')
                ->cascadeOnDelete();

            $table->unique(
                ['tanggal_data', 'kabupaten_id', 'jenis_ki_id', 'status'],
                'rekap_ki_harian_snapshot_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekap_ki_harian');
    }
};
