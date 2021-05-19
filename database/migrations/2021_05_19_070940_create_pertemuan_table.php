<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePertemuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertemuan', function (Blueprint $table) {
            $table->integer('pertemuan_id')->autoIncrement();
            $table->integer('kelas_id')->nullable($value=false);
            $table->integer('pertemuan_ke')->nullable($value=false);
            $table->date('tanggal')->nullable($value=false);
            $table->string('materi', 50)->nullable($value=true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pertemuan');
    }
}
