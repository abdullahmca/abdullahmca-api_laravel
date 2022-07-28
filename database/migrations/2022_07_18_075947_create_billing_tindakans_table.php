<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBillingTindakansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_tindakans', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nama')->nullable();
            $table->text('alamat')->nullable();
            $table->text('kode_billing')->nullable();
            $table->text('no_admisi')->nullable();
            $table->string('nomor_rm')->nullable();
            $table->string('penjamin')->nullable();
            $table->string('nominal')->nullable();
            $table->string('id_faskes')->nullable();
            $table->string('tgl_admisi')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('billing_tindakans');
    }
}
