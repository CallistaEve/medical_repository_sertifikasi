<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('jumlah');
            $table->decimal('harga', 12, 2);
            $table->enum('kategori', ['obat', 'peralatan', 'barang_habis_pakai']);

            // Khusus Obat
            $table->string('dosis')->nullable();
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->enum('butuh_resep', ['Iya', 'Tidak'])->nullable();

            // Khusus Peralatan Medis
            $table->string('departemen')->nullable();
            $table->string('status_operasional')->nullable();
            $table->date('jadwal_pemeliharaan')->nullable();

            // Khusus Barang Habis Pakai
            $table->string('jenis_penggunaan')->nullable();
            $table->string('status_sterilisasi')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
};
