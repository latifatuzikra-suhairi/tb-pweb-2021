<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->integer('absensi_id')->autoIncrement();
            $table->integer('krs_id')->nullable($value=false);
            $table->foreign('krs_id')->references('krs_id')->on('krs');
            $table->integer('pertemuan_id')->nullable($value=false);
            $table->foreign('pertemuan_id')->references('pertemuan_id')->on('pertemuan');
            $table->time('jam_masuk')->nullable($value=true);
            $table->time('jam_keluar')->nullable($value=true);
            $table->integer('durasi')->nullable($value=true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}
