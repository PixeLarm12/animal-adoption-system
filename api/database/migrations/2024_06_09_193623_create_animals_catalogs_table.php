<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animals_catalogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('animal_id');
            $table->unsignedBigInteger('catalog_id');

            $table->foreign('animal_id')->references('id')->on('animals');
            $table->foreign('catalog_id')->references('id')->on('catalogs');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals_catalogs');
    }
};
