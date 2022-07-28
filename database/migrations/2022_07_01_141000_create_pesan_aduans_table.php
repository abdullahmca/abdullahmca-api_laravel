<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePesanAduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan_aduans', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('id_admin')->nullable();
            $table->string('create_date')->nullable();
            $table->string('waktu_trobel')->nullable();
            $table->text('pesan')->nullable();
            $table->string('id_user')->nullable();
            $table->text('ket_penanganan')->nullable();
            $table->string('penanganan')->nullable();
            $table->string('waktu_penanganan')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('update_date')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pesan_aduans');
    }
}
