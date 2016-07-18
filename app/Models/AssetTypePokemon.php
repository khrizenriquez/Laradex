<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pokemons;

class AssetTypePokemon extends Model
{
	protected $table = 'asset_types_pokemons';

    //
    public function createAssetPokemon ($typeId, $nationalId, $path = '') {
    	$img = new AssetTypePokemon();

   		try {
   			$img->asset_type_id 	= $typeId;
	   		$img->pokemon_id 	    = $nationalId;
	   		$img->path 					  = $path;
	   		$img->save();
   		} catch (Exception $e) {
   			$img = null;
   		}

   		return $img;
    }
}
