<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_ki', function (Blueprint $table) {
            $table->id();

            // User Kabupaten/Kota yang mengajukan
            $table->foreignId('user_pengaju_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Data pengajuan
           $table->integer('jenis_ki_id');
$table->foreign('jenis_ki_id')
    ->references('id')
    ->on('jenis_ki');

$table->integer('kabupaten_id');
$table->foreign('kabupaten_id')
    ->references('id')
    ->on('kabupaten');

            $table->string('pemilik');
            $table->unsignedSmallInteger('tahun');
            $table->date('tanggal_pengajuan')->nullable();
            $table->text('keterangan')->nullable();

            // Status proses penelaahan
            $table->string('status_pengajuan')
                ->default('menunggu_penelaahan');

            $table->text('catatan_admin')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_ki');
    }
};
