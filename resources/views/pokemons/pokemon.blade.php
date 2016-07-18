@extends('layouts.master')

@section('title', 'Page Title')

@section('content')

@include('partials.navbar')

<div class="container pokedex pokedex-bg pokedex-style">
	<div class="row">
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-12">
					<h1 class="text-center" id="pokemonTitle"></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-12 col-sm-5">
							<figure class="text-center center-div">
								<img id="previewPokemon" />
							</figure>

							<div>
								<label>Reproducir grito</label>
								<div>
									<button id="playSoudPokemon" type="button" class="btn btn-default">
										<i class="glyphicon glyphicon-play"></i> Reproducir grito
									</button>
									<!-- <audio controls>
										<source src="{{ asset('sounds/150.ogg') }}" type="audio/ogg" />
										Your browser does not support the audio element.
									</audio> -->
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-7">
							<div class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-4">Hp</label>
							    	<div class="col-sm-8">
							    		<div class="progress">
							    			<div class="progress-bar progress-bar-striped active progress-bar-info" role="progressbar" aria-valuemax="100" style="width: 0%"></div>
										</div>
								    </div>

								    <label class="col-sm-4">Ataque</label>
							    	<div class="col-sm-8">
							    		<div class="progress">
							    			<div class="progress-bar progress-bar-striped active progress-bar-info" role="progressbar" aria-valuemax="100" style="width: 0%"></div>
										</div>
								    </div>

							    	<label class="col-sm-4">Defensa</label>
							    	<div class="col-sm-8">
							    		<div class="progress">
							    			<div class="progress-bar progress-bar-striped active progress-bar-info" role="progressbar" aria-valuemax="100" style="width: 0%"></div>
										</div>
								    </div>

								    <label class="col-sm-4">Ataque especial</label>
							    	<div class="col-sm-8">
							    		<div class="progress">
							    			<div class="progress-bar progress-bar-striped active progress-bar-info" role="progressbar" aria-valuemax="100" style="width: 0%"></div>
										</div>
								    </div>

								    <label class="col-sm-4">Def especial</label>
							    	<div class="col-sm-8">
							    		<div class="progress">
							    			<div class="progress-bar progress-bar-striped active progress-bar-info" role="progressbar" aria-valuemax="100" style="width: 0%"></div>
										</div>
								    </div>

								    <label class="col-sm-4">Velocidad</label>
							    	<div class="col-sm-8">
							    		<div class="progress">
							    			<div class="progress-bar progress-bar-striped active progress-bar-info" role="progressbar" aria-valuemax="100" style="width: 0%"></div>
										</div>
								    </div>
								</div>

								<!-- <div class="form-group">
									<div class="col-sm-4">
										<label>Tipo</label>
									</div>
									<div class="col-sm-8">
										<span class="label label-default font-1-5">Psíquico</span>
										<span class="label label-default font-1-5">Psíquico</span>
										<span class="label label-default font-1-5">Psíquico</span>
										<span class="label label-default font-1-5">Psíquico</span>
									</div>
								</div> -->

								<div class="form-group">
									<div id="description" class="col-sm-12"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-md-2">
					<a href="{{ route('editar', $id) }}" type="button" class="btn btn-default btn-block">Editar</a>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-2">
					<button id="deletePokemon" type="button" class="btn btn-default btn-block">Eliminar</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="deletePokemonModal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Título</h4>
      		</div>
      		<div class="modal-body">
        		<p>¿Estás seguro de querer eliminar este pokémon, está acción no se puede revertir?</p>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        		<button onclick="return deletePokemon('{{ $id }}')" id="deletePokemon" type="button" class="btn btn-danger">Eliminar</button>
      		</div>
    	</div>
  	</div>
</div>

@endsection

@section('scripts')
<script>
	'use strict'

	let pokemonData = {}
	let arr = []

	let animationsBar = function () {
		let maxAttributes = 300
		$(".progress-bar").each(function (index, element) {
			$(element).animate({
				width: `${(parseInt(arr[index]) * 100) / maxAttributes}%`
			}, {
				duration: 2000, 
				complete: function () {
					this.className = "progress-bar progress-bar-info"
				}
			})
		})
	}

	let getInfo = $.getJSON('/pokemons/{{ $id }}', {}, function () {})
	getInfo.done(function (response) {
		let r 		= response.pokemon
		pokemonData = r

		arr.push(r.hp)
		arr.push(r.attack)
		arr.push(r.defense)
		arr.push(r.special_attack)
		arr.push(r.special_defense)
		arr.push(r.speed)
		animationsBar()

		let image 	= document.querySelector('#previewPokemon')
		image.src 	= r.image
		image.alt 	= r.name
		image.title = r.name

		//	Sonido
		let audio = new Audio(r.sound)
		s.addEventListener('click', function (evt) {
			audio.play()
		})
	})
	getInfo.fail(function (err) {
		console.error(err)
	})

	document.querySelector('#deletePokemon').addEventListener('click', function (evt) {
		$('#deletePokemonModal .modal-title').html(`¿Eliminar a ${pokemonData.name}?`)
		$('#deletePokemonModal').modal('show')
	})

	function deletePokemon (idPokemon) {
		let id = idPokemon || null

		if (id === null) return

		let deletePokemon = $.ajax({
			method: "delete",
			url: '/pokemons/{{ $id }}',
			data: {
				"_token": "{{ csrf_token() }}",
			}
		})
		deletePokemon.done(function (response) {
			if (response.status == 'OK') {
				window.location = '/';
			}
		})
		deletePokemon.fail(function (err) {
			console.error(err)
		})
	}

	let s = document.querySelector('#playSoudPokemon')

	
</script>
@endsection