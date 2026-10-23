<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_pengajuan_ki', function (Blueprint $table) {
            $table->id();

            $table->integer('data_ki_id');

$table->foreign('data_ki_id')
    ->references('id')
    ->on('data_ki')
    ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('status_sebelumnya')->nullable();
            $table->string('status_baru');
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_pengajuan_ki');
    }
};
