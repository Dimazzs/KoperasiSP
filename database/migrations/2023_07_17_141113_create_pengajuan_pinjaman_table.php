<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_pinjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota_id');
            $table->foreign('anggota_id')->references('id')->on('anggota')->onDelete('cascade');
            $table->string('nama_barang'); // Kolom nama_barang ditambahkan
            $table->decimal('jumlah_pinjaman', 10, 2);
            $table->integer('tenor');
            $table->enum('status', ['proses', 'terima', 'ditolak'])->default('proses');
            $table->string('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan_pinjaman');
    }
};
