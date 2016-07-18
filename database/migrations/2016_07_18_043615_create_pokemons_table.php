<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePokemonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemons', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('national_pokedex')->unique()->unsigned();
            $table->string('name', 50);
            $table->string('slug_name', 50)->unique();
            $table->tinyInteger('hp')->unsigned();
            $table->tinyInteger('attack')->unsigned();
            $table->tinyInteger('defense')->unsigned();
            $table->tinyInteger('special_attack')->unsigned();
            $table->tinyInteger('special_defense')->unsigned();
            $table->tinyInteger('speed')->unsigned();
            $table->text('description');

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
        Schema::drop('pokemons');
    }
}
