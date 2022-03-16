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
        Schema::create('irna_user', function (Blueprint $table) {
            $table->id();
            $table->string('irna_nama');
            $table->string('irna_username')->unique();
            $table->integer('irna_role');
            $table->string('irna_password');
            $table->tinyInteger('irna_status');
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
        Schema::dropIfExists('irna_user');
    }
};
