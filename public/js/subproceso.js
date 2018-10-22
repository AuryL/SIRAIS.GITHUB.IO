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
    }
    // else {
    //     alert("Perfecto");
    // }
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
var domSelected = function (dominio) {
    console.log('domSelected');
    console.log(dominio);

    var idioma = document.getElementById("idioma").value;

    $.get("http://127.0.0.1:8000/api/cargar_datosFiltroDominio/" + dominio, function (data) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datosProc:data', data);

        if (data && data.length > 0) {// Verificar que no esta vacia "data"

            document.getElementById("proc_id_filtro").disabled = false; // habilitar boton al llenar campos del formulario
            $("#proc_id_filtro").empty();

            if (idioma == "es") {
                $("#proc_id_filtro").append('<option selected value="0" disabled="disabled" > Proceso </option>');
                data.forEach(function (valor) {
                    $("#proc_id_filtro").append('<option value="' + valor.proc_id + '">' + valor.proc_nombre_es + '</option>');
                });
            } else {
                if (idioma == "en") {
                    $("#proc_id_filtro").append('<option selected value="0" disabled="disabled" > Proceso </option>');
                    data.forEach(function (valor) {
                        $("#proc_id_filtro").append('<option value="' + valor.proc_id + '">' + valor.proc_nombre_en + '</option>');
                    });
                }
            }

        } else {// Si el array "data" recibido esta vacia
            $(".col-md-6").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
}











//////////////////////////////////////////////////
var procSelected = function (proceso) {
    console.log('procSelected');
    console.log(proceso);

    var idioma = document.getElementById("idioma").value;


    $.get("http://127.0.0.1:8000/api/cargar_datosFiltroProceso/" + proceso, function (data) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datosProc:data', data);

        if (data && data.length > 0) {// Verificar que no esta vacia "data"
            console.log("hola");
            document.getElementById("subproceso").disabled = false; // habilitar boton al llenar campos del formulario
            $("#subproceso").empty();

            if (idioma == "es") {
                $("#subproceso").append('<option selected value="0" disabled="disabled" > Subproceso </option>');
                data.forEach(function (valor) {
                    $("#subproceso").append('<option value="' + valor.subp_id + '">' + valor.subp_nombre_es + '</option>');
                });
            } else {
                if (idioma == "en") {
                    $("#subproceso").append('<option selected value="0" disabled="disabled" > Subprocess </option>');
                    data.forEach(function (valor) {
                        $("#subproceso").append('<option value="' + valor.subp_id + '">' + valor.subp_nombre_es + '</option>');
                    });
                }
            }

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

                document.getElementById("subp_id").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("subp_nombre_es").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("subp_nombre_en").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("subp_detalles_es").disabled = false; // habilitar boton al llenar campos del formulario 
                document.getElementById("subp_detalles_en").disabled = false; // habilitar boton al llenar campos del formulario  
                document.getElementById("proceso").disabled = false; // habilitar boton al llenar campos del formulario 
                document.getElementById("subp_estado").disabled = false; // habilitar boton al llenar campos del formulario  

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



