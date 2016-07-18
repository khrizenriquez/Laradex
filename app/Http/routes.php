<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'PokemonController@show');
Route::get('/pokemon/{identifier}', 'PokemonController@pokemonInfo');

Route::put('/pokemons-update', 'PokemonController@updateInfo');

Route::get('/pokemons/crear', ['as' => 'crear', function () {
    return view('pokemons.create');
}]);
Route::get('/pokemons/editar/{identifier}', 'PokemonController@showEditInfo')->name('editar');

//	RestAPI
Route::get('/pokemons', 'PokemonController@getAll');
Route::post('/pokemons', 'PokemonController@store');
Route::get('/pokemons/{identifier}', 'PokemonController@getPokemonInfo');
Route::delete('/pokemons/{identifier}', 'PokemonController@deletePokemonInfo');
Route::put('/pokemons/{identifier}', 'PokemonController@deletePokemonInfo');
