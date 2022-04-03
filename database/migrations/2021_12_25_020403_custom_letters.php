<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomLetters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_letters', function(Blueprint $table){
            $table->id();
            $table->string('from');
            $table->string('date')->default(Date('D').'-'.Date('M').'-'.Date('Y'));
            $table->string('title')->nullable();
            $table->string('icons')->nullable();
            $table->string('body')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->string('perihal')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('salam_pembuka')->nullable();
            $table->string('penutup')->nullable();
            $table->string('ttd')->nullable();
            $table->string('tembusan')->nullable();
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
        Schema::dropIfExists('custom_letters');
    }
}
