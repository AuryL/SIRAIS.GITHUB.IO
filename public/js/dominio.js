var validarDom = function () {

    var escribirNombreEs = document.getElementById("dom_nombre_es");
    var escribirNombreEn = document.getElementById("dom_nombre_en");
    var escribirDetallesEs = document.getElementById("dom_detalles_es");
    var escribirDetallesEn = document.getElementById("dom_detalles_en");


    console.log(escribirNombreEs.value);
    console.log(escribirNombreEn.value);
    console.log(escribirDetallesEs.value);
    console.log(escribirDetallesEn.value);

    if (escribirNombreEs.value == null || escribirNombreEn.value == null || escribirDetallesEs.value == null || escribirDetallesEn.value == null) {
        alert("Debes llenar todos los campos");
        return false
    } else {
        alert("Perfecto");
    }
}




//////////////////////////////////////////////////
var dominioSelected = function (dominio) {
    console.log('dominioSelected');
    console.log(dominio);

    $.get("http://127.0.0.1:8000/api/cargar_datosdom/" + dominio, function (data) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datosDom:data', data);

        if (data && data.length > 0) {// Verificar que no esta vacia "data"
            data.forEach(function (valor) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"


                document.getElementById("dom_id").value = valor.dom_id;
                document.getElementById("dom_nombre_es").value = valor.dom_nombre_es;
                document.getElementById("dom_nombre_en").value = valor.dom_nombre_en;
                document.getElementById("dom_detalles_es").value = valor.dom_detalles_es;
                document.getElementById("dom_detalles_en").value = valor.dom_detalles_en;

                if (valor.dom_estado == 1) { // Colocar el Estado del usuario con jquery
                    document.getElementsByName("dom_estado").value = 1;
                    $("#dom_estado").prop('checked', true);
                } else {
                    if (valor.dom_estado == 0) {
                        document.getElementsByName("dom_estado").value = 0;
                        $("#dom_estado").prop('checked', false);
                    }
                }

                document.getElementById("boton_modificar").disabled = false; // habilitar boton al llenar campos del formulario

            });

        } else {// Si el array "data" recibido esta vacia
            $(".col-md-6").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
}