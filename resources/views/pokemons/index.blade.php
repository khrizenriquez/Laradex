@extends('layouts.master')

@section('title', '- Inicio')

@section('content')

@include('partials.navbar')

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="text-center" id="title">Son solo </h1>

			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<a href="{{ route('crear') }}" type="button" class="btn btn-success btn-block">Crear pokémon</a>
				</div>
				<div class="col-xs-12 col-sm-5 col-sm-offset-3">
					<div class="form-group has-feedback">
						<label for="index-search">Nombre o número de pokémon</label>
				    	<input id="index-search" class="form-control" type="text" placeholder="Nombre o número de pokémon" maxlength="15" />
				    	<span class="glyphicon glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
				  	</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container" id="pokemonsContainer">
	<div class="row text-center"></div>
</div>

@endsection

@section('scripts')

<script src="/js/allPokemons.js"></script>

@endsection