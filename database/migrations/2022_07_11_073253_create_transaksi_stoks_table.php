<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransaksiStoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_stoks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('kode_brg')->nullable();
            $table->string('nik_admin')->nullable();
            $table->string('stok_akhir')->nullable();
            $table->string('create_date')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('jumlah_awal')->nullable();
            $table->string('keterangan')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transaksi_stoks');
    }
}
