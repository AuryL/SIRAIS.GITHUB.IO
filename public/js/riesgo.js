var validarRgo = function () {

    var escribirNombreEs = document.getElementById("rgo_nombre_es");
    var escribirNombreEn = document.getElementById("rgo_nombre_en");
    var escribirDetallesEs = document.getElementById("rgo_detalles_es");
    var escribirDetallesEn = document.getElementById("rgo_detalles_en");


    console.log(escribirNombreEs.value);
    console.log(escribirNombreEn.value);
    console.log(escribirDetallesEs.value);
    console.log(escribirDetallesEn.value);

    var selectedSubpId = document.getElementById("subproceso");
    var subpId = selectedSubpId.options[selectedSubpId.selectedIndex].text;

    console.log(subpId);

    if (subpId == "subproceso") {
        alert("Debes seleccionar un Subproceso")
        return false
    }

    if (escribirNombreEs.value == null || escribirNombreEn.value == null || escribirDetallesEs.value == null || escribirDetallesEn.value == null) {
        alert("Debes llenar todos los campos");
        return false
    } else {
        alert("Perfecto");
    }
}
//////////////////////
var validarCont = function (cont_id) {
    console.log()

    var escribirNombreEs = document.getElementById("cont_nombre_es");
    var escribirNombreEn = document.getElementById("cont_nombre_en");
    var escribirDetallesEs = document.getElementById("cont_detalles_es");
    var escribirDetallesEn = document.getElementById("cont_detalles_en");

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
/////////////////////////////////////////////////
var validarAct = function () {

    var escribirNombreEs = document.getElementById("act_nombre_es");
    var escribirNombreEn = document.getElementById("act_nombre_en");
    var escribirDetallesEs = document.getElementById("act_detalles_es");
    var escribirDetallesEn = document.getElementById("act_detalles_en");

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





/////////////////////////////////////////////
// $(document).ready(function () {
//     // var prueba = function () {
//         console.log("hola");
//     $('#boton_modificar_control').click(function (e) {
//         // $('#boton_modificar_control').on('click', function (e) {

//             e.preventDefault();
//             $.ajaxSetup({
//                 headers: {
//                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//                 }
//             });
//             $.ajax({
//                 url: "{{ url('/control/cont_viewModificar') }}",
//                 method: 'post',
//                 data: {
//                     rgo_id: $('#rgo_id').val(),
//                     cont_nombre_es: $('#cont_nombre_es').val(),
//                     cont_nombre_en: $('#cont_nombre_en').val(),
//                     cont_detalles_es: $('#cont_detalles_es').val(),
//                     cont_detalles_en: $('#cont_detalles_en').val(),
//                     cont_estado: $('#cont_estado').val()
//                 },
//                 success: function (result) {
//                     $('.alert').show();
//                     $('.alert').html(result.success);
//                 }
//             });
//         });
//     });





////////////////////////////// Permite deslizar el div de controles y actividades, que corresponde a cada Riesgo
$(document).ready(function () {
    $("#div_flex_riesgos_controles").click(function () {
        $("#div_control").slideToggle("slow");
    });

    $("#div_flex_riesgos_actividades").click(function () {
        $("#div_actividad").slideToggle("slow");
    });


    $("#boton_modificar_control").click(function () {
        // $('#boton_modificar_control').on('click', function (e) {

        console.log("hola");
        // e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('/control/cont_viewModificar') }}",
            method: 'post',
            data: {
                rgo_id: $('#rgo_id').val(),
                cont_nombre_es: $('#cont_nombre_es').val(),
                cont_nombre_en: $('#cont_nombre_en').val(),
                cont_detalles_es: $('#cont_detalles_es').val(),
                cont_detalles_en: $('#cont_detalles_en').val(),
                cont_estado: $('#cont_estado').val()
            },
            success: function (result) {
                $('.alert').show();
                // $('.alert').html(result.success);
                $("#div_control").html("<div>" + result.success + "</div>");
            }
        });
    });
});






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

                $.get("http://127.0.0.1:8000/api/cargar_domId/" + dom_id, function (data2) {// Se direcciona a la url especificada (api.php)
                    // Posteriormente, recibe el resultado de la petición, que es data

                    console.log("data2", data2);
                    if (data2 && data2.length > 0) {// Verificar que no esta vacia "data"
                        data2.forEach(function (valor2) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
                            document.getElementById("dom_id").value = valor2.dom_nombre_es;
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
var procRiesgo = function (subproceso) {
    console.log('procRiesgo');
    console.log("SUBPROCESO: " + subproceso);
    var proceso = "";

    $.get("http://127.0.0.1:8000/api/cargar_rgoId/" + subproceso, function (data1) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datosSubproceso:data1', data1);

        if (data1 && data1.length > 0) {// Verificar que no esta vacia "data"
            data1.forEach(function (valor) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
                proceso = valor.proc_id;
                console.log("proceso: " + proceso);

                $.get("http://127.0.0.1:8000/api/cargar_procId/" + proceso, function (data2) {// Se direcciona a la url especificada (api.php)
                    // Posteriormente, recibe el resultado de la petición, que es data

                    console.log("data2", data2);
                    if (data2 && data2.length > 0) {// Verificar que no esta vacia "data"
                        data2.forEach(function (valor2) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
                            document.getElementById("proceso").value = valor2.proc_nombre_es;
                            document.getElementById("proceso").disabled = true; // habilitar boton al llenar campos del formulario
                            domSubproceso(valor2.proc_id);

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





////////////////////// CONTROLES ASOIADOS ////////////////////////////
var contSelect = function (riesgo) {
    console.log('contRiesgo');
    console.log("RIESGO: " + riesgo);

    $.get("http://127.0.0.1:8000/api/cargar_contSelect/" + riesgo, function (data1) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datosControl:data1', data1);
        $("#control").empty();
        $("#control").append("<option selected value='0' disabled='disabled' > Control </option>");
        if (data1 && data1.length > 0) {// Verificar que no esta vacia "data"
            data1.forEach(function (valor) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
                $("#control").append("<option id='control' value='" + valor.cont_id + "'>" + valor.cont_nombre_es + "</option>");
            });
        } else {// Si el array "data" recibido esta vacia
            $("#div_controlSeleccionado").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
}
var contRiesgo = function (cont_id) {
    console.log('contRiesgo');
    console.log("CONTROL: " + cont_id);

    $.get("http://127.0.0.1:8000/api/cargar_contRiesgo/" + cont_id, function (data1) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datosControl:data1', data1);

        if (data1 && data1.length > 0) {// Verificar que no esta vacia "data"
            data1.forEach(function (valor) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
                document.getElementById("cont_nombre_es").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("cont_nombre_en").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("cont_detalles_es").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("cont_detalles_en").disabled = false; // habilitar boton al llenar campos del formulario 
                document.getElementById("cont_estado").disabled = false; // habilitar boton al llenar campos del formulario   

                document.getElementById("rgo_id_control").value = valor.rgo_id;
                document.getElementById("cont_nombre_es").value = valor.cont_nombre_es;
                document.getElementById("cont_nombre_en").value = valor.cont_nombre_en;
                document.getElementById("cont_detalles_es").value = valor.cont_detalles_es;
                document.getElementById("cont_detalles_en").value = valor.cont_detalles_en;

                console.log(document.getElementById("rgo_id_control").value);
                console.log(document.getElementById("cont_nombre_es").value);
                console.log(document.getElementById("cont_nombre_en").value);
                console.log(document.getElementById("cont_detalles_es").value);
                console.log(document.getElementById("cont_detalles_en").value);

                if (valor.cont_estado == 1) { // Colocar el Estado del usuario con jquery
                    $("#cont_estado").prop('checked', true);
                } else {
                    if (valor.cont_estado == 0) {
                        $("#cont_estado").prop('checked', false);
                    }
                }

                // $("#boton_modificar_control").attr("onclick", "prueba()");
                // $("#boton_modificar_control").attr("onclick", "validarCont(" + valor.cont_id + ")");
                document.getElementById("boton_modificar_control").disabled = false; // habilitar boton al llenar campos del formulario   


            });
        } else {// Si el array "data" recibido esta vacia
            $("#control").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
}
////////////////////// ACTIVIDADES ASOIADAS ////////////////////////////
var actSelect = function (riesgo) {
    console.log('actSelect');
    console.log("RIESGO: " + riesgo);

    $.get("http://127.0.0.1:8000/api/cargar_actSelect/" + riesgo, function (data1) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datosControl:data1', data1);
        $("#actividad").empty();
        $("#actividad").append("<option selected value='0' disabled='disabled' > Actividad </option>");
        if (data1 && data1.length > 0) {// Verificar que no esta vacia "data"
            data1.forEach(function (valor) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
                $("#actividad").append("<option id='actividad' value='" + valor.act_id + "'>" + valor.act_nombre_es + "</option>");
            });
        } else {// Si el array "data" recibido esta vacia
            $("#actividad").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
}
var actRiesgo = function (act_id) {
    console.log('actRiesgo');
    console.log("RIESGO: " + act_id);

    $.get("http://127.0.0.1:8000/api/cargar_actRiesgo/" + act_id, function (data1) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datosControl:data1', data1);

        if (data1 && data1.length > 0) {// Verificar que no esta vacia "data"
            data1.forEach(function (valor) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
                document.getElementById("act_nombre_es").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("act_nombre_en").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("act_detalles_es").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("act_detalles_en").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("act_estado").disabled = false; // habilitar boton al llenar campos del formulario

                document.getElementById("rgo_id_control").value = valor.rgo_id;
                document.getElementById("act_nombre_es").value = valor.act_nombre_es;
                document.getElementById("act_nombre_en").value = valor.act_nombre_en;
                document.getElementById("act_detalles_es").value = valor.act_detalles_es;
                document.getElementById("act_detalles_en").value = valor.act_detalles_en;

                console.log(document.getElementById("rgo_id_control").value);
                console.log(document.getElementById("act_nombre_es").value);
                console.log(document.getElementById("act_nombre_en").value);
                console.log(document.getElementById("act_detalles_es").value);
                console.log(document.getElementById("act_detalles_en").value);

                if (valor.act_estado == 1) { // Colocar el Estado del usuario con jquery
                    $("#act_estado").prop('checked', true);
                } else {
                    if (valor.act_estado == 0) {
                        $("#act_estado").prop('checked', false);
                    }
                }

            });
        } else {// Si el array "data" recibido esta vacia
            $("#actividad").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
}







//////////////////////////////////////////////////
var riesgoSelected = function (riesgo) {
    console.log('riesgoSelected');
    console.log(riesgo);

    $.get("http://127.0.0.1:8000/api/cargar_datosRgo/" + riesgo, function (data) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datosrgo:data', data);

        if (data && data.length > 0) {// Verificar que no esta vacia "data"
            data.forEach(function (valor) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
                document.getElementById("rgo_nombre_es").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("rgo_nombre_en").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("rgo_detalles_es").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("rgo_detalles_en").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("subproceso").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("rgo_estado").disabled = false; // habilitar boton al llenar campos del formulario

                document.getElementById("rgo_id").value = valor.rgo_id;
                document.getElementById("rgo_nombre_es").value = valor.rgo_nombre_es;
                document.getElementById("rgo_nombre_en").value = valor.rgo_nombre_en;
                document.getElementById("rgo_detalles_es").value = valor.rgo_detalles_es;
                document.getElementById("rgo_detalles_en").value = valor.rgo_detalles_en;
                document.getElementById("subproceso").value = valor.subp_id;

                // limpoar controles
                document.getElementById("rgo_id_control").value = "";
                document.getElementById("cont_nombre_es").value = "";
                document.getElementById("cont_nombre_en").value = "";
                document.getElementById("cont_detalles_es").value = "";
                document.getElementById("cont_detalles_en").value = "";
                $("#cont_estado").prop('checked', false);
                document.getElementById("cont_nombre_es").disabled = true; // habilitar boton al llenar campos del formulario
                document.getElementById("cont_nombre_en").disabled = true; // habilitar boton al llenar campos del formulario
                document.getElementById("cont_detalles_es").disabled = true; // habilitar boton al llenar campos del formulario
                document.getElementById("cont_detalles_en").disabled = true; // habilitar boton al llenar campos del formulario 
                document.getElementById("cont_estado").disabled = true; // habilitar boton al llenar campos del formulario   
                document.getElementById("div_control").style.display = "none";

                // limpiar actividades
                document.getElementById("rgo_id_control").value = "";
                document.getElementById("act_nombre_es").value = "";
                document.getElementById("act_nombre_en").value = "";
                document.getElementById("act_detalles_es").value = "";
                document.getElementById("act_detalles_en").value = "";
                $("#act_estado").prop('checked', false);
                document.getElementById("act_nombre_es").disabled = true; // habilitar boton al llenar campos del formulario
                document.getElementById("act_nombre_en").disabled = true; // habilitar boton al llenar campos del formulario
                document.getElementById("act_detalles_es").disabled = true; // habilitar boton al llenar campos del formulario
                document.getElementById("act_detalles_en").disabled = true; // habilitar boton al llenar campos del formulario
                document.getElementById("act_estado").disabled = true; // habilitar boton al llenar campos del formulario
                document.getElementById("div_actividad").style.display = "none";


                procRiesgo(valor.subp_id);
                contSelect(valor.rgo_id);
                actSelect(valor.rgo_id);

                console.log(document.getElementById("rgo_id").value);
                console.log(document.getElementById("rgo_nombre_es").value);
                console.log(document.getElementById("rgo_nombre_en").value);
                console.log(document.getElementById("rgo_detalles_es").value);
                console.log(document.getElementById("rgo_detalles_en").value);
                console.log(document.getElementById("subproceso").value);


                if (valor.rgo_estado == 1) { // Colocar el Estado del usuario con jquery
                    document.getElementsByName("rgo_estado").value = 1;
                    $("#rgo_estado").prop('checked', true);
                } else {
                    if (valor.rgo_estado == 0) {
                        document.getElementsByName("rgo_estado").value = 0;
                        $("#rgo_estado").prop('checked', false);
                    }
                }

                document.getElementById("boton_modificar").disabled = false; // habilitar boton al llenar campos del formulario

            });

        } else {// Si el array "data" recibido esta vacia
            $(".col-md-6").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
}







//////////////////////////////////////////////////////