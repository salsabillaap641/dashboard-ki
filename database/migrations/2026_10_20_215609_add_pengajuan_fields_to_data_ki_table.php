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
    Schema::table('data_ki', function (Blueprint $table) {
        $table->foreignId('user_pengaju_id')
            ->nullable()
            ->after('id')
            ->constrained('users')
            ->nullOnDelete();

        $table->string('status_pengajuan')
            ->default('diterima')
            ->after('status');

        $table->text('catatan_admin')
            ->nullable()
            ->after('status_pengajuan');
    });
}

public function down(): void
{
    Schema::table('data_ki', function (Blueprint $table) {
        $table->dropConstrainedForeignId('user_pengaju_id');
        $table->dropColumn(['status_pengajuan', 'catatan_admin']);
    });
}

};
