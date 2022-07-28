<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblUserFaskesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_user_faskes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('menu')->nullable();
            $table->string('link')->nullable();
            $table->string('icon')->nullable();
            $table->string('parent')->nullable();
            $table->string('id_master')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_user_faskes');
    }
}
