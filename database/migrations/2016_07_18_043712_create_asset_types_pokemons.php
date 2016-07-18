<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetTypesPokemons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_types_pokemons', function (Blueprint $table) {
            $table->increments('id');

            $table->string('path');
            $table->integer('asset_type_id')->unsigned();
            $table->integer('pokemon_id')->unsigned();

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
        Schema::drop('asset_types_pokemons');
    }
}
