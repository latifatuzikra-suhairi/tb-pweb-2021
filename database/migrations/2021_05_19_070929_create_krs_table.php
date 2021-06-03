<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->integer('krs_id')->autoIncrement();
            $table->integer('kelas_id')->nullable($value=false);
            $table->foreign('kelas_id')->references('kelas_id')->on('kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('mahasiswa_id')->nullable($value=false);
            $table->foreign('mahasiswa_id')->references('mahasiswa_id')->on('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('krs');
    }
}
