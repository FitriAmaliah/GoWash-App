<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layanan'); // Kolom untuk Nama Layanan
            $table->text('deskripsi');     // Kolom untuk Deskripsi
            $table->decimal('harga', 10, 2); // Kolom untuk Harga
            $table->string('foto')->nullable(); // Kolom untuk Foto Layanan
            $table->timestamps();          // Kolom untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layanan');
    }
}
