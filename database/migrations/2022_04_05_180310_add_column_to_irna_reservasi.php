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
        Schema::table('irna_reservasi', function (Blueprint $table) {
            $table->integer('jumlah_tamu')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('irna_reservasi', function (Blueprint $table) {
            $table->dropColumn('jumlah_tamu');
        });
    }
};
