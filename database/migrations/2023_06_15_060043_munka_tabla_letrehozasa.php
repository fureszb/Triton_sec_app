<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ugyfel', function (Blueprint $table){
            $table->id('UgyfelID');
            $table->unsignedBigInteger('SzereloID');
            $table->unsignedBigInteger('SzolgID');
            $table->unsignedBigInteger('MunkaID');
            $table->string('Nev');
            $table->string('Email');
            $table->string('ObjCim');
            $table->string('Telefon');
            $table->string('SzamNev');
            $table->string('SzamCim');
            $table->datetime('KezdDatum');
            $table->datetime('BefDatum');
            $table->string('AdoSzam')->nullable()->default(null);
            $table->text('FelhasznaltAnyagok');
            $table->timestamps();

            $table->foreign('SzereloID')->references('SzereloID')->on('szerelo');
            $table->foreign('SzolgID')->references('SzolgID')->on('szolgaltatas');
            $table->foreign('MunkaID')->references('MunkaID')->on('munka');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ugyfel');
    }
};
