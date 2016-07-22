@extends('layouts.master')

@section('title', 'Page Title')

@section('content')

<form action="/pokemons" method="post" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	{{-- {{ csrf_field() }} --}}
	<div class="container pokemons-create-container">
		<div class="row">
			<div class="col-xs-12">
				<h1 class="text-center">Crear pokémon</h1>

				<div class="row">
					<div class="col-xs-12 col-sm-5">
						<figure class="text-center center-div pointer relative">
							<img name="imagePreview" id="imagePreview" class="image-preview" src="" alt="" />

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
						    		<input id="pokemonName" name="pokemonName" type="text" class="form-control" placeholder="Nombre pokémon" />
							    </div>

							    <label class="col-sm-4">Número pokedex</label>
						    	<div class="col-sm-8">
						    		<input id="nationalPokedex" name="nationalPokedex" type="text" class="form-control" placeholder="Número pokedex" />
							    </div>

							    <label class="col-sm-4">Hp</label>
						    	<div class="col-sm-8">
						    		<input id="hp" name="hp" type="text" class="form-control" placeholder="Hp" />
							    </div>

							    <label class="col-sm-4">Ataque</label>
						    	<div class="col-sm-8">
						    		<input id="attack" name="attack" type="text" class="form-control" placeholder="Ataque" />
							    </div>

						    	<label class="col-sm-4">Defensa</label>
						    	<div class="col-sm-8">
						    		<input id="defense" name="defense" type="text" class="form-control" placeholder="Defensa" />
							    </div>

							    <label class="col-sm-4">Ataque especial</label>
						    	<div class="col-sm-8">
						    		<input id="specialAttack" name="specialAttack" type="text" class="form-control" placeholder="Ataque especial" />
							    </div>

							    <label class="col-sm-4">Def especial</label>
						    	<div class="col-sm-8">
						    		<input id="specialDefense" name="specialDefense" type="text" class="form-control" placeholder="Defensa especial" />
							    </div>

							    <label class="col-sm-4">Velocidad</label>
						    	<div class="col-sm-8">
						    		<input id="speed" name="speed" type="text" class="form-control" placeholder="Velocidad" />
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
										<tbody></tbody>
									</table>
								</div>
							</div> -->

							<div class="form-group">
								<div class="col-sm-4">
									<label>Descripción</label>
								</div>
								<div class="col-sm-8">
									<textarea class="form-control" placeholder="Descripción" name="description" id="description" cols="30" rows="10"></textarea>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-4">
									<label>Grito del pokémon</label>
								</div>
								<div class="col-sm-8">
									<input name="scream" id="scream" type="file" />
									<button id="playSound" type="button" class="btn btn-default"><i class="glyphicon glyphicon-play"></i> Reproducir</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-3 col-md-2">
						<button type="submit" class="btn btn-default btn-block">Crear</button>
					</div>
				</div>
			</div>
		</div>
	</div>

</form>

@endsection

@section('scripts')

<script>
	drawPrettyUpload('#uploadImage', '.upload-image')

	$('#uploadImage').on('change', function (element) {
		readURL(this, '#imagePreview')
	})

	let playSound = document.querySelector('#playSound');
	playSound.addEventListener('click', function (evt) {
		let input = document.querySelector('#scream')
		if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	        	let audio = new Audio(e.target.result)
				audio.play()
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	})
</script>

@endsection