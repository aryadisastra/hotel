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
        Schema::create('irna_reservasi', function (Blueprint $table) {
            $table->id();
            $table->string('irna_kode')->unique();
            $table->integer('irna_id_tamu');
            $table->dateTime('irna_checkin');
            $table->dateTime('irna_checkout');
            $table->string('irna_pesan')->nullable(true);
            $table->integer('irna_total');
            $table->integer('irna_no_kamar');
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
        Schema::dropIfExists('irna_reservasi');
    }
};
