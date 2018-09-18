var validar = function () {

    var selectedPerfilId = document.getElementById("per_id");
    var selectedDominioId = document.getElementById("dom_id");

    var perfilId = selectedPerfilId.options[selectedPerfilId.selectedIndex].text;
    var dominioId = selectedDominioId.options[selectedDominioId.selectedIndex].text;

    if (perfilId == "Perfil" || dominioId == "Dominio") {
        alert("Debes seleccionar un Perfil y Domino")
        return false
    }
}

//////////////////////////////////////////////////
var expedienteSelected = function (expediente) {
    console.log('expedienteSelected');
    console.log(expediente);

    $.get("http://127.0.0.1:8000/api/cargar_datosUser/" + expediente, function (data) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datosUsuario:data', data);

        if (data && data.length > 0) {// Verificar que no esta vacia "data"
            data.forEach(function (valor) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"

                document.getElementById("username").value = valor.username;
                document.getElementById("name").value = valor.name;
                document.getElementById("us_apellidopat").value = valor.us_apellidopat;
                document.getElementById("us_apellidomat").value = valor.us_apellidomat;
                document.getElementById("us_extension").value = valor.us_extension;
                document.getElementById("email").value = valor.email;
                document.getElementById("per_id").value = valor.per_id;
                document.getElementById("dom_id").value = valor.dom_id;

                if (valor.us_estado == 1) { // Colocar el Estado del usuario con jquery
                    document.getElementsByName("us_estado").value = 1;
                    $("#us_estado").prop('checked', true);
                } else {
                    if (valor.us_estado == 0) {
                        document.getElementsByName("us_estado").value = 0;
                        $("#us_estado").prop('checked', false);
                    }
                }

                document.getElementById("boton_modificar").disabled = false; // habilitar boton al llenar campos del formulario

            });

        } else {// Si el array "data" recibido esta vacia
            $(".col-md-6").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });

}