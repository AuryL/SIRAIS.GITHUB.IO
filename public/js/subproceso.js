var validarSubp = function () {

    var escribirNombreEs = document.getElementById("subp_nombre_es");
    var escribirNombreEn = document.getElementById("subp_nombre_en");
    var escribirDetallesEs = document.getElementById("subp_detalles_es");
    var escribirDetallesEn = document.getElementById("subp_detalles_en");


    console.log(escribirNombreEs.value);
    console.log(escribirNombreEn.value);
    console.log(escribirDetallesEs.value);
    console.log(escribirDetallesEn.value);

    var selectedProcesoId = document.getElementById("proceso");
    var procesoId = selectedProcesoId.options[selectedProcesoId.selectedIndex].text;

    console.log(procesoId);

    if (procesoId == "Proceso") {
        alert("Debes seleccionar un Proceso")
        return false
    }

    if (escribirNombreEs.value == null || escribirNombreEn.value == null || escribirDetallesEs.value == null || escribirDetallesEn.value == null) {
        alert("Debes llenar todos los campos");
        return false
    } else {
        alert("Perfecto");
    }
}







//////////////////////////////////////////////////
var domSubproceso = function (proceso) {
    console.log('domSubproceso');
    console.log("PROCESO: " + proceso);
    var dom_id = "";


    $.get("http://127.0.0.1:8000/api/cargar_subpId/" + proceso, function (data1) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datosProceso:data1', data1);

        if (data1 && data1.length > 0) {// Verificar que no esta vacia "data"
            data1.forEach(function (valor) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
                dom_id = valor.dom_id;
                console.log("dom_id: " + dom_id);
                
                var idioma = document.getElementById("idioma").value;
                console.log("idioma: " + idioma);

                $.get("http://127.0.0.1:8000/api/cargar_domId/" + dom_id, function (data2) {// Se direcciona a la url especificada (api.php)
                    // Posteriormente, recibe el resultado de la petición, que es data

                    console.log("data2", data2);
                    if (data2 && data2.length > 0) {// Verificar que no esta vacia "data"
                        data2.forEach(function (valor2) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"

                            // var idioma = document.getElementById("idioma").value;
                            // console.log("idioma: " + idioma);
                            if (idioma == "es") {
                                document.getElementById("dom_id").value = valor2.dom_nombre_es;
                            } else {
                                if (idioma == "en") {
                                    document.getElementById("dom_id").value = valor2.dom_nombre_en;
                                }
                            }
                            document.getElementById("dom_id").disabled = true; // habilitar boton al llenar campos del formulario
                        });
                    } else {// Si el array "data" recibido esta vacia
                        $(".col-md-6").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
                    }
                });
            });
        } else {// Si el array "data" recibido esta vacia
            $(".col-md-6").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
}





//////////////////////////////////////////////////
var subprocesoSelected = function (subproceso) {
    console.log('subprocesoSelected');
    console.log(subproceso);

    $.get("http://127.0.0.1:8000/api/cargar_datosSubp/" + subproceso, function (data) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datossubp:data', data);

        if (data && data.length > 0) {// Verificar que no esta vacia "data"
            data.forEach(function (valor) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"


                document.getElementById("subp_id").value = valor.subp_id;
                document.getElementById("subp_nombre_es").value = valor.subp_nombre_es;
                document.getElementById("subp_nombre_en").value = valor.subp_nombre_en;
                document.getElementById("subp_detalles_es").value = valor.subp_detalles_es;
                document.getElementById("subp_detalles_en").value = valor.subp_detalles_en;
                document.getElementById("proceso").value = valor.proc_id;
                domSubproceso(valor.proc_id);


                console.log(document.getElementById("subp_id").value);
                console.log(document.getElementById("subp_nombre_es").value);
                console.log(document.getElementById("subp_nombre_en").value);
                console.log(document.getElementById("subp_detalles_es").value);
                console.log(document.getElementById("subp_detalles_en").value);
                console.log(document.getElementById("proceso").value);


                if (valor.subp_estado == 1) { // Colocar el Estado del usuario con jquery
                    document.getElementsByName("subp_estado").value = 1;
                    $("#subp_estado").prop('checked', true);
                } else {
                    if (valor.subp_estado == 0) {
                        document.getElementsByName("subp_estado").value = 0;
                        $("#subp_estado").prop('checked', false);
                    }
                }

                document.getElementById("boton_modificar").disabled = false; // habilitar boton al llenar campos del formulario
            });

        } else {// Si el array "data" recibido esta vacia
            $(".col-md-6").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
}