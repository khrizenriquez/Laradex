'use strict'

var getRandomInt = function (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min
}

// http://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded
function readURL (input, imageSelector) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(imageSelector).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


//		Haciendo que el input de subir imagen se vea decente
var drawPrettyUpload = function (fileSelector, buttonSelector) {
    var wrapper = $("<div style='height: 0; width: 0; overflow: hidden;'><div>")
    var fileImagen = $(fileSelector).wrap(wrapper)

    //todos los evento que tenga se los quito
    $(buttonSelector).off("click")

    //agrego el evento click para que lo escuche el elemento
    $(buttonSelector).on("click", function(event, objetct) {
        fileImagen.click()
    }).show()
}
