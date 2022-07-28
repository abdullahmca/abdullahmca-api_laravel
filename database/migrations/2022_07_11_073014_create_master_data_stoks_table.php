<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasterDataStoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_data_stoks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('jenis_brg')->nullable();
            $table->string('nama_brg')->nullable();
            $table->string('kode_brg')->nullable();
            $table->string('nik_admin')->nullable();
            $table->string('stok_akhir')->nullable();
            $table->string('create_date')->nullable();
            $table->string('update_date')->nullable();
            $table->string('satuan_pertama')->nullable();
            $table->string('satuan_terkecil')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('master_data_stoks');
    }
}
