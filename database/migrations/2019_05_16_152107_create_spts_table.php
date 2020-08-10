<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('jenis_spt_id');
            $table->string('name');
            $table->integer('nomor')->nullable();
            $table->timestamp('tgl_mulai');
            $table->timestamp('tgl_akhir');
            $table->string('lokasi');
            /*$table->json('anggota');*/
            $table->enum('approval_status',['approved','rejected','processing'])->default('processing');
            $table->unsignedBigInteger('approval_by')->nullable()->comment('Approval User ID');
            $table->text('notes')->nullable()->comment('give note if approval status rejected');
            $table->timestamps();

            $table->foreign('jenis_spt_id')->references('id')->on('jenis_spt')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spt');
    }
}
