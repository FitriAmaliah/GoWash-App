<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            // Menambahkan kolom untuk ID member
            $table->unsignedBigInteger('id_member')->after('user_id')->nullable(); // ID member (opsional)
    
            // Menambahkan kolom untuk plat nomor dan jenis kendaraan
            $table->string('plat_nomor')->after('biaya'); // Plat nomor kendaraan
            $table->string('jenis_kendaraan')->after('plat_nomor'); // Jenis kendaraan
    
            // Menambahkan foreign key untuk id_member yang merujuk ke tabel users
            $table->foreign('id_member')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            // Menghapus foreign key dan kolom jika rollback
            $table->dropForeign(['id_member']);
            $table->dropColumn(['id_member', 'plat_nomor', 'jenis_kendaraan']);
        });
    }
    
};
