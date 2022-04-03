<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MyLetters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_letters', function(Blueprint $table){
            $table->id();
            $table->string('from');
            $table->string('name');
            $table->string('date')->default(Date('D').'-'.Date('M').'-'.Date('Y'));
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('title')->nullable();
            $table->string('icons')->nullable();
            $table->longtext('body')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->string('perihal')->nullable();
            $table->string('tujuan')->nullable();
            $table->longtext('salam_pembuka')->nullable();
            $table->longtext('penutup')->nullable();
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
        Schema::dropIfExists('my_letters');
    }
}
