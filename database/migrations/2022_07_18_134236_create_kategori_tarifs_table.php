<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKategoriTarifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_tarifs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('kategori_tarif')->nullable();
            $table->string('parent')->nullable();
            $table->string('aktif')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kategori_tarifs');
    }
}
