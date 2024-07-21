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
        Schema::table('users', function (Blueprint $table) {
            // Periksa apakah kolom 'role_id' sudah ada
            if (!Schema::hasColumn('users', 'role_id')) {
                $table->foreignId('role_id')
                    ->nullable()
                    ->constrained('roles') // Menetapkan foreign key ke tabel 'roles'
                    ->onUpdate('cascade') // Menetapkan aturan on update
                    ->onDelete('set null'); // Menetapkan aturan on delete
            } else {
                // Periksa apakah foreign key constraint sudah ada
                if (!Schema::hasTable('users')) {
                    $table->foreign('role_id')
                        ->references('id')->on('roles')
                        ->onUpdate('cascade')
                        ->onDelete('set null');
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus foreign key constraint dan kolom 'role_id'
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
