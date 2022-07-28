<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserOpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_opds', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nik')->nullable();
            $table->string('nama_user')->nullable();
            $table->string('kode_opd')->nullable();
            $table->string('password')->nullable();
            $table->string('nip')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_opds');
    }
}
