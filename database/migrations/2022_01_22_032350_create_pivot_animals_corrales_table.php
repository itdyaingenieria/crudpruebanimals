<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotAnimalsCorralesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_animals_corrales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('animals_id');
            $table->bigInteger('corrales_id');
            $table->bigInteger('cantidad'); 
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
        Schema::dropIfExists('pivot_animals_corrales');
    }
}
