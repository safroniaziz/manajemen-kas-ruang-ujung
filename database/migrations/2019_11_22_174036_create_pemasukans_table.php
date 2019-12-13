<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemasukansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemasukans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kas_id');
            $table->unsignedInteger('user_id');
            $table->date('tanggal_pemasukan');
            $table->unsignedInteger('periode_id');
            $table->string('sumber_pemasukan');
            $table->integer('jumlah_pemasukan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemasukans');
    }
}
