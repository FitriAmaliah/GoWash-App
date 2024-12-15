<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUlasanTable extends Migration
{
    public function up()
    {
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id(); // Auto incrementing ID
            $table->string('nama_pengguna'); // Kolom untuk nama pengguna
            $table->integer('rating'); // Kolom untuk rating
            $table->text('komentar'); // Kolom untuk komentar
            $table->timestamp('tanggal_ulasan')->useCurrent(); // Kolom untuk tanggal ulasan
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('ulasan'); // Menghapus tabel 'ulasan' saat rollback
    }
}
