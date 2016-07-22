<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
	protected $table = 'pokemons';

    //
    public function createPokemon ($parameters = []) {
    	$p = new Pokemon();
    	try {
    		extract($parameters);

	   		$p->national_pokedex 	= $nationalPokedex;
	   		$p->hp 					= $hp;
	   		$p->name 				= $pokemonName;
	   		//$p->slug_name 			= '';
	   		$p->attack 				= $attack;
	   		$p->defense 			= $defense;
	   		$p->special_attack 		= $specialAttack;
	   		$p->special_defense 	= $specialDefense;
	   		$p->speed 				= $speed;
	   		$p->description 		= $description;

	   		$p->save();
    	} catch (Exception $e) {
    		$p = null;
    	}

    	return $p;
    }

    public function updatePokemon ($parameters = []) {
    	extract($parameters);

    	$p = static::where('id', '=', $actual)->first();
    	try {

	   		$p->national_pokedex 	= $nationalPokedex;
	   		$p->hp 					= $hp;
	   		$p->name 				= $pokemonName;
	   		//$p->slug_name 			= $pokemonName;
	   		$p->attack 				= $attack;
	   		$p->defense 			= $defense;
	   		$p->special_attack 		= $specialAttack;
	   		$p->special_defense 	= $specialDefense;
	   		$p->speed 				= $speed;
	   		$p->description 		= $description;

	   		$p->save();
    	} catch (Exception $e) {
    		$p = null;
    	}

    	return $p;
    }
}
