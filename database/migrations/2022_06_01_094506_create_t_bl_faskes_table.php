<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTBlFaskesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_bl_faskes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nomor_admisi')->nullable();
            $table->string('nomor_rm')->nullable();
            $table->date('tgl_admisi')->nullable();
            $table->string('kode_faskes')->nullable();
            $table->string('kode_penjamin')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_bl_faskes');
    }
}
