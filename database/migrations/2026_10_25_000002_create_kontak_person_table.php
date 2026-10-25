<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontak_person', function (Blueprint $table) {
            $table->id();
            $table->text('alamat');
            $table->string('nomor_admin', 30);
            $table->string('email')->nullable();
            $table->string('jam_layanan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontak_person');
    }
};
