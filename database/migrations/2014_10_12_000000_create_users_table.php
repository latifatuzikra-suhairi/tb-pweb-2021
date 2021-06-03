<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('role');
            $table->string('username');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    // public function save( array $options = [] ) {
        
    //     if ( ! $this->exists && empty( $this->getAttribute( 'password' ) ) ) {
            

    //          $this->password = mt_rand(1000000, 9999999);
            
    //     }
    //     return parent::save( $options );
    // }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    } 
}
