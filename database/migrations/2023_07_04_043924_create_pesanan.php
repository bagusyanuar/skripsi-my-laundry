<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('paket_id')->unsigned();
            $table->date('tanggal');
            $table->string('no_pesanan')->unique();
            $table->float('berat')->default(0);
            $table->integer('harga')->default(0);
            $table->float('total')->default(0);
            $table->text('alamat')->nullable();
            $table->smallInteger('status');
            $table->string('nama_bank')->default('-');
            $table->string('atas_nama')->default('-');
            $table->string('no_rekening')->default('-');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('paket_id')->references('id')->on('paket');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}
