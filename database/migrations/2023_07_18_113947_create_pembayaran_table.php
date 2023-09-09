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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_pinjaman_id');
            $table->decimal('jumlah_pembayaran', 10, 2);
            $table->date('tanggal_pembayaran');
            $table->timestamps();
            $table->foreign('pengajuan_pinjaman_id')->references('id')->on('pengajuan_pinjaman')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
