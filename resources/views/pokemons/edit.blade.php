@extends('layouts.master')

@section('title', 'Page Title')

@section('content')

<form action="/pokemons-update" method="post" enctype="multipart/form-data">
	{{ method_field('PUT') }}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" id="actual" name="actual" value="{{ $pokemon->id }}" />
	<div class="container pokemons-edit-container">
		<div class="row">
			<div class="col-xs-12">
				<h1 class="text-center">Editar el pokémon {{ $pokemon->name }}</h1>

				<div class="row">
					<div class="col-xs-12 col-sm-5">
						<figure class="text-center center-div">
							<img name="imagePreview" id="imagePreview" src="{{ asset($pokemon->image) }}" alt="{{ $pokemon->name }}" />

							<input type="file" id="uploadImage" name="uploadImage" />

							<button type="button" class="btn btn-default upload-image">
								<span class="glyphicon glyphicon-upload"></span> Subir imagen
							</button>
						</figure>
					</div>
					<div class="col-xs-12 col-sm-7">
						<div class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-4">Nombre</label>
						    	<div class="col-sm-8">
						    		<input id="pokemonName" name="pokemonName" type="text" class="form-control" placeholder="Nombre pokémon" value="{{ $pokemon->name }}" />
							    </div>

							    <label class="col-sm-4">Número pokedex</label>
						    	<div class="col-sm-8">
						    		<input id="nationalPokedex" name="nationalPokedex" type="text" class="form-control" placeholder="Número pokedex" value="{{ $pokemon->national_pokedex }}" />
							    </div>
							    <label class="col-sm-4">Hp</label>
						    	<div class="col-sm-8">
						    		<input id="hp" name="hp" type="text" class="form-control" placeholder="Hp" value="{{ $pokemon->hp }}" />
							    </div>
								<label class="col-sm-4">Ataque</label>
						    	<div class="col-sm-8">
						    		<input id="attack" name="attack"  type="text" class="form-control" placeholder="Ataque" value="{{ $pokemon->attack }}" />
							    </div>

						    	<label class="col-sm-4">Defensa</label>
						    	<div class="col-sm-8">
						    		<input id="defense" name="defense" type="text" class="form-control" placeholder="Defensa" value="{{ $pokemon->defense }}" />
							    </div>

							    <label class="col-sm-4">Ataque especial</label>
						    	<div class="col-sm-8">
						    		<input id="specialAttack" name="specialAttack" type="text" class="form-control" placeholder="Ataque especial" value="{{ $pokemon->special_attack }}" />
							    </div>

							    <label class="col-sm-4">Def especial</label>
						    	<div class="col-sm-8">
						    		<input id="specialDefense" name="specialDefense" type="text" class="form-control" placeholder="Defensa especial" value="{{ $pokemon->special_defense }}" />
							    </div>

							    <label class="col-sm-4">Velocidad</label>
						    	<div class="col-sm-8">
						    		<input id="speed" name="speed" type="text" class="form-control" placeholder="Velocidad" value="{{ $pokemon->speed }}" />
							    </div>
							</div>

							<!-- <div class="form-group">
								<div class="col-sm-4">
									<label>Tipo</label>
								</div>
								<div class="col-sm-8">
									<table class="table table-condensed table-hover">
										<thead>
											<tr>
												<td>Tipo</td>
												<td>Eliminar</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Tipo 1</td>
												<td><button class="btn btn-danger">Eliminar</button></td>
											</tr>
											<tr>
												<td>Tipo 2</td>
												<td><button class="btn btn-danger">Eliminar</button></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div> -->

							<div class="form-group">
								<div class="col-sm-4">
									<label>Descripción</label>
								</div>
								<div class="col-sm-8">
									<textarea class="form-control" placeholder="Descripción" name="description" id="description" cols="30" rows="10">{{ $pokemon->description }}</textarea>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-4">
									<label>Grito del pokémon</label>
								</div>
								<div class="col-sm-8">
									<input name="scream" id="scream" type="file" value="{{ asset($pokemon->sound) }}" />
									<button id="playSound" type="button" class="btn btn-default"><i class="glyphicon glyphicon-play"></i> Reproducir</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-3 col-md-2">
						<button type="submit" class="btn btn-default btn-block">Editar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

@endsection

@section('scripts')
<script src="{{ asset('js/buffer-loader.js') }}"></script>
<script>
	drawPrettyUpload('#uploadImage', '.upload-image')

	$('#uploadImage').on('change', function (element) {
		readURL(this, '#imagePreview')
	})

	let s = document.querySelector('#playSoudPokemon')

	// let b = document.querySelector('#')
	// b.addEventListener('click', function (evt) {
		
	// })
	// $("form").submit(function(event) {
	//   	console.log($(this).serializeArray() );
	//   	event.preventDefault();
	// });

	let playSound = document.querySelector('#playSound');
	let input = document.querySelector('#scream')
	let data = '{{ asset($pokemon->sound) }}' || null
	playSound.addEventListener('click', function (evt) {

		input.addEventListener('change', function (evt) {
			data = null
		})

		if (data !== null) {
			var context;
			var bufferLoader;

			function init() {
			  // Fix up prefixing
			  window.AudioContext = window.AudioContext || window.webkitAudioContext;
			  context = new AudioContext();

			  bufferLoader = new BufferLoader(
			    context,
			    [
			      '{{ asset($pokemon->sound) }}',
			    ],
			    finishedLoading
			    );

			  bufferLoader.load();
			}
			init()

			function finishedLoading(bufferList) {
			  // Create two sources and play them both together.
			  var source1 = context.createBufferSource();
			  source1.buffer = bufferList[0];

			  source1.connect(context.destination);
			  source1.start(0);
			}
		} else {
			if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		        	let sound = e.target.result
		        	let audio = new Audio(sound)
					audio.play()
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}
	})
</script>

@endsection