<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irna_kamar', function (Blueprint $table) {
            $table->id();
            $table->integer('irna_nomor')->unique();
            $table->integer('irna_lantai');
            $table->integer('irna_tipe');
            $table->integer('irna_maximal');
            $table->integer('irna_harga');
            $table->integer('irna_status');
            $table->text('irna_fasilitas');
            $table->text('irna_foto');
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
        Schema::dropIfExists('irna_kamar');
    }
};
