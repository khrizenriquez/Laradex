<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

use DB;

use App\Http\Requests;
use App\Models\Pokemon;
use App\Models\AssetType;
use App\Models\AssetTypePokemon;

class PokemonController extends Controller
{
	
	//	Show (one)
    //	Create
    public function store (Request $request) {
    	$r = $request->all();
   		/*
   			Valores de el pokémon {ataque, defensa, ataque especial, defensa especial, velocidad}
   		*/

   		DB::beginTransaction();
   		$response = [];
   		try {
   			//Pokemon::create([data]);

   			$p 		= new Pokemon();
   			$create = $p->createPokemon($r);

	   		$nationalId = $create->id;

	   		//	Moviendo la imagen
	   		$imagePath = $this->uploadImage($request, 'uploadImage');
	   		$soundPath = $this->uploadSound($request, 'scream');

	        //	Moviendo archivo de sonido

	   		//	Path de la imagen
	   		$image = new AssetTypePokemon();
	   		$image->createAssetPokemon(
   				AssetType::getImagesType(), 
   				$nationalId, 
   				$imagePath
	   		);

   			//	Path del grito
   			$sound = new AssetTypePokemon();
	   		$sound->createAssetPokemon(
   				AssetType::getSoundType(),
   				$nationalId, 
   				$soundPath
	   		);

	   		DB::commit();

	   		$response['status'] = '';
   			$response['message'] = $create;

   			return redirect()->route('crear');
   		} catch (Exception $e) {
   			DB::rollBack();
   			$response['status'] = '';
   			$response['message'] = '';
   		}

   		return $response;
   	}

   	public function updateInfo (Request $request) {
   		$r = $request->all();
   		/*
   			Valores de el pokémon {ataque, defensa, ataque especial, defensa especial, velocidad}
   		*/

   		DB::beginTransaction();
   		$response = [];
   		try {
   			$p 		= new Pokemon();
   			$update = $p->updatePokemon($r);

	   		$nationalId = $update->id;

	   		//	Moviendo la imagen
	   		$imagePath = $this->uploadImage($request, 'uploadImage');
	   		$soundPath = $this->uploadSound($request, 'scream');

	        //	Moviendo archivo de sonido

	   		//	Path de la imagen
	   		if (!is_null($imagePath)) {
	   			$image = new AssetTypePokemon();
		   		$image->createAssetPokemon(
	   				AssetType::getImagesType(), 
	   				$nationalId, 
	   				$imagePath
		   		);
	   		}

   			//	Path del grito
   			if (!is_null($soundPath)) {
   				$sound = new AssetTypePokemon();
		   		$sound->createAssetPokemon(
	   				AssetType::getSoundType(),
	   				$nationalId, 
	   				$soundPath
		   		);
   			}

	   		DB::commit();

	   		$response['status'] = '';
   			$response['message'] = $update;

   			return redirect('/');
   		} catch (Exception $e) {
   			DB::rollBack();
   			$response['status'] = '';
   			$response['message'] = '';
   		}

   		return $response;
   	}

   	public function uploadImage ($request, $imageName) {
   		$relativePath = '/img/pokemons/';

   		if ($request->hasFile($imageName)) {
    		$file = $request->file($imageName);
            //getting timestamp
            //$timestamp = str_replace([' ', ':'], '_', Carbon::now()->toDateTimeString());
            $timestamp = md5(time().mt_rand(0, 100));

            $name = $timestamp. '__' .$file->getClientOriginalName();
            //$name = $file->getClientOriginalName();

            $imagePath 		= $relativePath.$name;
            $file->move(public_path().$relativePath, $name);

            return $imagePath;
        }

        return null;
   	}

   	public function uploadSound ($request, $soundName) {
   		$relativePath = '/sounds/';

   		if ($request->hasFile($soundName)) {
    		$file = $request->file($soundName);
            //getting timestamp
            $timestamp = md5(time().mt_rand(0, 100));

            $name = $timestamp. '__' .$file->getClientOriginalName();

            $imagePath 		= $relativePath.$name;
            $file->move(public_path().$relativePath, $name);

            return $imagePath;
        }

        return null;
   	}

   	//	Index (all)
	public function show () {
		return view('pokemons.index');
	}

	public function getAll (Request $request) {
		$search = $request->query('search');
		$order 	= $request->query('order');
		if (is_null($search)) {
			$search = '';
		}
		//	Obteniendo todos los pokémon
		$p = Pokemon::join(DB::raw('asset_types_pokemons image'), 'pokemons.id', '=', DB::raw('image.pokemon_id and image.asset_type_id = 1'))
			// ->join(DB::raw('asset_types_pokemons sound'), 'pokemons.id', '=', DB::raw('sound.pokemon_id and sound.asset_type_id = 2'))
			->where('pokemons.name', 'like', '%'.$search.'%')
			->orWhere('pokemons.national_pokedex', 	'=', $search)
			->select('pokemons.*', 
					// DB::raw('MAX(sound.path) path'), 
					DB::raw('MAX(image.path) path'))
			->groupBy('pokemons.national_pokedex')
			->get();
		/*
		Select 
			pokemons.name, 
		    pokemons.national_pokedex, 
		    image.path, 
		    sound.path
			from pokemons
		inner join asset_types_pokemons image on pokemons.id = image.pokemon_id 
			and image.asset_type_id = 1
		inner join asset_types_pokemons sound on pokemons.id = sound.pokemon_id 
			and sound.asset_type_id = 2
		;
		*/

		return ['pokemons' => $p];
	}

	public function pokemonInfo ($identifier = 1) {
		return view('pokemons.pokemon', ['id' => $identifier]);
	}
	public function getPokemonInfo ($identifier = 1) {
		//	Obteniendo todos los pokémon
		$p = Pokemon::join(DB::raw('asset_types_pokemons image'), 'pokemons.id', '=', DB::raw('image.pokemon_id and image.asset_type_id = 1'))
			->join(DB::raw('asset_types_pokemons sound'), 'pokemons.id', '=', DB::raw('sound.pokemon_id and sound.asset_type_id = 2'))
			->select('pokemons.*', 
					'sound.path as sound', 
					'image.path as image')
			->where('pokemons.national_pokedex', '=', $identifier)
			->get()
			->first();

		return ['pokemon' => $p];
	}

	public function showEditInfo ($identifier = 1) {
		//	Obteniendo todos los pokémon
		$p = Pokemon::join(DB::raw('asset_types_pokemons image'), 'pokemons.id', '=', DB::raw('image.pokemon_id and image.asset_type_id = 1'))
			->join(DB::raw('asset_types_pokemons sound'), 'pokemons.id', '=', DB::raw('sound.pokemon_id and sound.asset_type_id = 2'))
			->select('pokemons.*', 
					'sound.path as sound', 
					'image.path as image')
			->where('pokemons.national_pokedex', '=', $identifier)
			->get()
			->first();

		return view('pokemons.edit', ['pokemon' => $p]);
	}

	public function deletePokemonInfo ($identifier = null) {
		if (is_null($identifier)) return;

		try {
			$pokemon = Pokemon::where('national_pokedex', '=', $identifier);

		    $pokemon->delete();

		    $message = 'Eliminado correctamente';
		    $status = 'OK';
		} catch (Exception $e) {
			$message = $e->getMessage();
			$status = 'ERROR';
		}

		return ['pokemon' => $message, 'status' => $status];
	}
}
