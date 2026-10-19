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
    Schema::create('perpustakaan_ki', function (Blueprint $table) {
        $table->id();
        $table->string('nama_hak');
        $table->string('nomor_hak')->unique();

        $table->unsignedInteger('jenis_ki_id');
        $table->unsignedInteger('kabupaten_id');

        $table->timestamps();

        $table->foreign('jenis_ki_id')
            ->references('id')
            ->on('jenis_ki');

        $table->foreign('kabupaten_id')
            ->references('id')
            ->on('kabupaten');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perpustakaan_kis');
    }
};
