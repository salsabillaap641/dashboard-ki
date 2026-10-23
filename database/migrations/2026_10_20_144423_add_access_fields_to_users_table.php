
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique();
            $table->string('role')->default('kabupaten');
            $table->integer('kabupaten_id')->nullable();

            $table->foreign('kabupaten_id')
                ->references('id')
                ->on('kabupaten')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['kabupaten_id']);
            $table->dropUnique(['username']);

            $table->dropColumn([
                'username',
                'role',
                'kabupaten_id',
            ]);
        });
    }
};
