'use strict'

let fillPokemons = function (el, arr) {
	let data = arr.pokemons

	let base = $(`${el}`)
	base.html('')
	if (data.length > 0) {
		$('#title').html(`Son solo ${data.length}`)
	} else {
		$('#title').html(`Sin resultados`)
	}

	data.some(function (element, index, arr) {
		let l = element
		base.append(`<a href="/pokemon/${l.national_pokedex}">
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
				<div class="pokemons-list-container">
					<h3 class="pokemons-list-title">
						<span class="badge"># ${l.national_pokedex}</span> ${l.name}
					</h3>
					<figure class="center-div">
						<img class="img-circle" src="${l.path}" alt="${l.name}" />
					</figure>
				</div>
			</div>
		</a>`)
	})
}

//	Petición ajax para llenar la información de los pokémon
let getAll = $.getJSON('/pokemons', {}, function () {})

getAll.done(function (response) {
	fillPokemons('#pokemonsContainer div', response)
})
getAll.fail(function (err) {
	console.error(err)
})

//	Busqueda
document.querySelector('#index-search').addEventListener('keyup', function (evt) {
	let key = evt.keyCode || evt.which
	//	Enter, # de tecla 13
	if (key === 13) {
		let input = this.value

		let seach = $.getJSON('/pokemons', {
			'search': input
		}, function () {})

		seach.done(function (response) {
			console.log(response)
			fillPokemons('#pokemonsContainer div', response)
		})
		seach.fail(function (err) {
			console.error(err)
		})
	}
})
