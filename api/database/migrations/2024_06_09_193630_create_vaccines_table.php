<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vaccines', function (Blueprint $table) {
            $table->id();
            $table->string('title', 80);
            $table->date('date');
            $table->date('next')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('animal_id');

            $table->foreign('animal_id')->references('id')->on('animals');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vaccines');
    }
};
