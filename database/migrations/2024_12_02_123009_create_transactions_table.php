<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('no'); // Kolom no (primary key)
            $table->string('id_transaksi')->unique(); // Kolom id_transaksi
            $table->date('tanggal'); // Kolom tanggal
            $table->string('nama_pelanggan'); // Kolom nama_pelanggan
            $table->string('jenis_kendaraan'); // Kolom jenis_kendaraan
            $table->string('no_plat'); // Kolom no_plat
            $table->decimal('biaya', 15, 2); // Kolom biaya dengan tipe decimal
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}