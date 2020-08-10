<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetailSpt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_spt', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->unsignedBigInteger('spt_id');
            $table->unsignedBigInteger('user_id');
            /*$table->enum('peran',['Penanggung Jawab','Pengendali Mutu', 'Pengendali Teknis', 'Ketua Tim', 'Anggota Tim']);*/
            $table->string('peran');
            $table->integer('lama')->nullable();
            $table->float('dupak')->nullable();            

            $table->foreign('spt_id')->references('id')->on('spt');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_spt');
    }
}
