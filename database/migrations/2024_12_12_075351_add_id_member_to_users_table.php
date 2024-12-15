<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->integer('id_member')->nullable()->after('id'); // Menambahkan kolom id_member setelah kolom id
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('id_member'); // Untuk menghapus kolom id_member jika migration dirollback
    });
}

};
