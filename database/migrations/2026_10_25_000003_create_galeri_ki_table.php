<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri_ki', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->unsignedInteger('jenis_ki_id');
            $table->string('nomor_permohonan')->nullable();
            $table->text('caption');
            $table->string('foto');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            //$table->foreign('jenis_ki_id')->references('id')->on('jenis_ki')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_ki');
    }
};
