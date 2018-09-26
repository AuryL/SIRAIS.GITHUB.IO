var validarCont = function () {

    var escribirNombreEs = document.getElementById("cont_nombre_es");
    var escribirNombreEn = document.getElementById("cont_nombre_en");
    var escribirDetallesEs = document.getElementById("cont_detalles_es");
    var escribirDetallesEn = document.getElementById("cont_detalles_en");


    console.log(escribirNombreEs.value);
    console.log(escribirNombreEn.value);
    console.log(escribirDetallesEs.value);
    console.log(escribirDetallesEn.value);

    // var selectedRgoId = document.getElementById("riesgo");
    // var rgoId = selectedRgoId.options[selectedRgoId.selectedIndex].text;

    // console.log(rgoId);

    // if (rgoId == "riesgo") {
    //     alert("Debes seleccionar un Riesgo")
    //     return false
    // }

    if (escribirNombreEs.value == null || escribirNombreEn.value == null || escribirDetallesEs.value == null || escribirDetallesEn.value == null) {
        alert("Debes llenar todos los campos");
        return false
    } else {
        alert("Perfecto");
    }
}








var modificarControl = function (riesgo, cont_id) {

    console.log("riesgo" + riesgo);
    console.log("cont_id" + cont_id);


    $.get("http://127.0.0.1:8000/api/cargar_control/" + riesgo + "/" + cont_id, function (data) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datosControl:data', data);

        if (data && data.length > 0) {// Verificar que no esta vacia "data"
            data.forEach(function (valor) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"

                document.getElementById("rgo_id").value = valor.rgo_id;
                document.getElementById("cont_id").value = valor.cont_id;
                document.getElementById("cont_nombre_es").value = valor.cont_nombre_es;
                document.getElementById("cont_nombre_en").value = valor.cont_nombre_en;
                document.getElementById("cont_detalles_es").value = valor.cont_detalles_es;
                document.getElementById("cont_detalles_en").value = valor.cont_detalles_en;

                console.log(document.getElementById("cont_id").value);
                console.log(document.getElementById("cont_nombre_es").value);
                console.log(document.getElementById("cont_nombre_en").value);
                console.log(document.getElementById("cont_detalles_es").value);
                console.log(document.getElementById("cont_detalles_en").value);


                if (valor.cont_estado == 1) { // Colocar el Estado del usuario con jquery
                    document.getElementsByName("cont_estado").value = 1;
                    $("#cont_estado").prop('checked', true);
                } else {
                    if (valor.cont_estado == 0) {
                        document.getElementsByName("cont_estado").value = 0;
                        $("#cont_estado").prop('checked', false);
                    }
                }

                document.getElementById("boton_modificar").disabled = false; // habilitar boton al llenar campos del formulario

            });

        } else {// Si el array "data" recibido esta vacia
            $(".col-md-6").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });

}