<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->integer('kelas_id')->autoIncrement();
            $table->string('kode_kelas', 50)->nullable($value=false);
            $table->string('kode_makul', 50)->nullable($value=false);
            $table->string('nama_makul', 50)->nullable($value=false);
            $table->integer('tahun')->nullable($value=false);
            $table->integer('semester')->nullable($value=false);
            $table->integer('sks')->nullable($value=false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
