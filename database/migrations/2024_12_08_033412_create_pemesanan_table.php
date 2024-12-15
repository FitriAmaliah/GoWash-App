<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('layanan_id');  // Kolom untuk ID Layanan
            $table->unsignedBigInteger('user_id');  // Kolom untuk ID User (opsional)
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('metode_pembayaran');
            $table->enum('status_pembayaran', ['pending', 'success', 'failed']);
            $table->string('biaya');
            $table->timestamps();
    
            // Menambahkan foreign key untuk kolom layanan_id
            $table->foreign('layanan_id')->references('id')->on('layanan')->onDelete('cascade');
        });
    }    
};
