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
    Schema::create('rekap_ki_bulanan', function (Blueprint $table) {
        $table->id();

        $table->integer('kabupaten_id');
        $table->integer('jenis_ki_id');

        $table->string('status', 20);
        $table->unsignedTinyInteger('bulan');
        $table->unsignedSmallInteger('tahun');

        $table->unsignedInteger('jumlah')->default(0);

        $table->timestamps();

        $table->unique(
            ['kabupaten_id', 'jenis_ki_id', 'status', 'bulan', 'tahun'],
            'rekap_ki_bulanan_unique'
        );
    });
}

public function down(): void
{
    Schema::dropIfExists('rekap_ki_bulanan');
}

};
