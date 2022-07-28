<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePuskesmasTransaksiKeusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puskesmas_transaksi_keus', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('id_pos_keu')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('nik_user')->nullable();
            $table->string('nominal')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('puskesmas_transaksi_keus');
    }
}
