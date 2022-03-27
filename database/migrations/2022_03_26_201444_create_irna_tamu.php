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
        Schema::create('irna_tamu', function (Blueprint $table) {
            $table->id();
            $table->string('irna_no_identitas')->unique();
            $table->string('irna_nama');
            $table->string('irna_email');
            $table->string('irna_username');
            $table->string('irna_password');
            $table->string('irna_telpon');
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
        Schema::dropIfExists('irna_tamu');
    }
};
