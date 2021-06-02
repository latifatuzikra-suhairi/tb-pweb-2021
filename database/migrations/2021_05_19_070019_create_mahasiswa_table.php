<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->integer('mahasiswa_id')->autoIncrement();
            $table->integer('id')->nullable($value=false);
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama', 50)->nullable($value=false);
            $table->string('nim', 18)->nullable($value=false);
            $table->string('email', 50)->nullable($value=false);
            // $table->integer('tipe')->nullable($value=false);
            // $table->integer('password')->nullable($value=false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}
