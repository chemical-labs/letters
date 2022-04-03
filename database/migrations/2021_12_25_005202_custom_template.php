<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_template', function(Blueprint $table){
            $table->id();
            $table->string('tone')->nullable();
            $table->string('title')->nullable();
            $table->string('date')->nullable();
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('icons')->nullable();
            $table->string('body')->nullable();
            $table->string('from')->nullable();
            $table->boolean('tanggal')->default(false);
            $table->boolean('nomor_surat')->default(false);
            $table->boolean('perihal')->default(false);
            $table->boolean('tujuan')->default(false);
            $table->boolean('salam_pembuka')->default(false);
            $table->boolean('penutup')->default(false);
            $table->boolean('ttd')->default(false);
            $table->boolean('tembusan')->default(false);
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
        Schema::dropIfExsist('custom_template');
    }
}
