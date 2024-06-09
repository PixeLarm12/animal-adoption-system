<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_informations', function (Blueprint $table) {
            $table->id();
            $table->text('description', 255);
            $table->unsignedBigInteger('animal_id');

            $table->foreign('animal_id')->references('id')->on('animals');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_informations');
    }
};
