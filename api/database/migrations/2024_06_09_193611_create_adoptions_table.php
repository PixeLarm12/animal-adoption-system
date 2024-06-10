<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->string('status', 20);
            $table->date('adoption_date');
            $table->text('observation', 255)->nullable();
            $table->unsignedBigInteger('animal_id');
            $table->unsignedBigInteger('person_id');

            $table->foreign('animal_id')->references('id')->on('animals');
            $table->foreign('person_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};
