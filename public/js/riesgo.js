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
    } 
    // else {
    //     alert("Perfecto");
    // }
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
    } 
    // else {
    //     alert("Perfecto");
    // }
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
    } 
    // else {
    //     alert("Perfecto");
    // }
}







////////////////////////////// Permite deslizar el div de controles y actividades, que corresponde a cada Riesgo
$(document).ready(function () {
    $("#div_flex_riesgos_controles").click(function () {
        $("#div_control").slideToggle("slow");
    });

    $("#div_flex_riesgos_actividades").click(function () {
        $("#div_actividad").slideToggle("slow");
    });

    ////////////////////////////////INTENTOS PARA MODIFICAR CONTROL EN VISTA RIESGO
    $('#boton_modificar_control').click(function () {
        console.log("Dentro de Modificar Control en Riesgos!");
        var rgo_id = $('#rgo_id_control').val();
        var cont_id = $('#cont_id').val();
        var cont_nombre_es = $('#cont_nombre_es').val();
        var cont_nombre_en = $('#cont_nombre_en').val();
        var cont_detalles_es = $('#cont_detalles_es').val();
        var cont_detalles_en = $('#cont_detalles_en').val();
        var cont_estado = $('#cont_estado').val();

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        $.ajax({
            url: 'http://127.0.0.1:8000/api/modificarControl',
            method: 'POST',
            data: {
                'rgo_id': rgo_id,
                // 'cont_id': cont_id,
                'cont_nombre_es': cont_nombre_es,
                'cont_nombre_en': cont_nombre_en,
                'cont_detalles_es': cont_detalles_es,
                'cont_detalles_en': cont_detalles_en,
                'cont_estado': cont_estado
            },
            success: function (data) {

                $('#rgo_id_control_error').html('');
                // $('#cont_id_error').html('');
                $('#cont_nombre_es_error').html('');
                $('#cont_nombre_en_error').html('');
                $('#cont_detalles_es_error').html('');
                $('#cont_detalles_en_error').html('');
                $('#cont_estado_error').html('');


                $('#success_message').html('Modificacion guardada conrrectamente.');
            },
            error: function (data) {

                $('#rgo_id_control_error').html('');
                // $('#cont_id_error').html('');
                $('#cont_nombre_es_error').html('');
                $('#cont_nombre_en_error').html('');
                $('#cont_detalles_es_error').html('');
                $('#cont_detalles_en_error').html('');
                $('#cont_estado_error').html('');

                $('#success_message').html('Error');

                var error = data.responseJSON;
                $.each(error, function (key, value) {
                    if (key == 'rgo_id') {
                        $("#rgo_id_control_error").html(value);
                    }
                    // if (key == 'cont_id') {
                    //     $("#cont_id_error").html(value);
                    // }
                    if (key == 'cont_nombre_es') {
                        $("#cont_nombre_es_error").html(value);
                    }
                    if (key == 'cont_nombre_en') {
                        $("#cont_nombre_en_error").html(value);
                    }
                    if (key == 'cont_detalles_es') {
                        $("#cont_detalles_es_error").html(value);
                    }
                    if (key == 'cont_detalles_en') {
                        $("#cont_detalles_en_error").html(value);
                    }
                    if (key == 'cont_estado') {
                        $("#cont_estado_error").html(value);
                    }
                })

            }
        });
    });



    ////////////////////////////////INTENTOS PARA MODIFICAR ACTIVIDAD EN VISTA RIESGO
    $('#boton_modificar_actividad').click(function () {
        console.log("Dentro de Modificar Actividades en Riesgos!");
        var cont_id = $('#cont_id_actividad').val();
        var act_id = $('#act_id').val();
        var act_nombre_es = $('#act_nombre_es').val();
        var act_nombre_en = $('#act_nombre_en').val();
        var act_detalles_es = $('#act_detalles_es').val();
        var act_detalles_en = $('#act_detalles_en').val();
        var act_estado = $('#act_estado').val();

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        $.ajax({
            url: 'http://127.0.0.1:8000/api/modificarActividad',
            method: 'POST',
            data: {
                'cont_id': cont_id,
                // 'cont_id': cont_id,
                'act_nombre_es': act_nombre_es,
                'act_nombre_en': act_nombre_en,
                'act_detalles_es': act_detalles_es,
                'act_detalles_en': act_detalles_en,
                'act_estado': act_estado
            },
            success: function (data) {

                $('#cont_id_actividad_error').html('');
                // $('#cont_id_error').html('');
                $('#act_nombre_es_error').html('');
                $('#act_nombre_en_error').html('');
                $('#act_detalles_es_error').html('');
                $('#act_detalles_en_error').html('');
                $('#act_estado_error').html('');


                $('#success_message').html('Modificacion guardada conrrectamente.');
            },
            error: function (data) {

                $('#cont_id_actividad_error').html('');
                // $('#cont_id_error').html('');
                $('#act_nombre_es_error').html('');
                $('#act_nombre_en_error').html('');
                $('#act_detalles_es_error').html('');
                $('#act_detalles_en_error').html('');
                $('#act_estado_error').html('');

                $('#success_message').html('Error');

                var error = data.responseJSON;
                $.each(error, function (key, value) {
                    if (key == 'cont_id') {
                        $("#cont_id_actividad_error").html(value);
                    }
                    // if (key == 'act_id') {
                    //     $("#act_id_error").html(value);
                    // }
                    if (key == 'act_nombre_es') {
                        $("#act_nombre_es_error").html(value);
                    }
                    if (key == 'act_nombre_en') {
                        $("#act_nombre_en_error").html(value);
                    }
                    if (key == 'act_detalles_es') {
                        $("#act_detalles_es_error").html(value);
                    }
                    if (key == 'act_detalles_en') {
                        $("#act_detalles_en_error").html(value);
                    }
                    if (key == 'act_estado') {
                        $("#act_estado_error").html(value);
                    }
                })

            }
        });
    });
});






//////////////////////////////////////////////////
var domSubproceso_riesgo = function (proceso) {
    console.log('domSubproceso_riesgo');
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

                var idioma = document.getElementById("idioma").value;
                console.log("idioma: " + idioma);

                $.get("http://127.0.0.1:8000/api/cargar_procId/" + proceso, function (data2) {// Se direcciona a la url especificada (api.php)
                    // Posteriormente, recibe el resultado de la petición, que es data

                    console.log("data2", data2);
                    if (data2 && data2.length > 0) {// Verificar que no esta vacia "data"
                        data2.forEach(function (valor2) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"

                            if (idioma == "es") {
                                document.getElementById("proc_id").value = valor2.proc_nombre_es;
                            } else {
                                if (idioma == "en") {
                                    document.getElementById("proc_id").value = valor2.proc_nombre_en;
                                }
                            }

                            document.getElementById("proc_id").disabled = true; // habilitar boton al llenar campos del formulario
                            domSubproceso_riesgo(valor2.proc_id);

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
                
                var idioma = document.getElementById("idioma").value;
                console.log("idioma: " + idioma);

                if (idioma == "es") {
                    $("#control").append("<option id='control' value='" + valor.cont_id + "'>" + valor.cont_nombre_es + "</option>");

                } else {
                    if(idioma == "en") {
                        $("#control").append("<option id='control' value='" + valor.cont_id + "'>" + valor.cont_nombre_en + "</option>");

                    }
                }

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


                actSelect(valor.cont_id);

                // $("#boton_modificar_control").click(function () {
                //     aurora(valor.cont_id);
                // });


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
                document.getElementById("_control").disabled = false; // habilitar boton al llenar campos del formulario   


            });
        } else {// Si el array "data" recibido esta vacia
            $("#control").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
}
////////////////////// ACTIVIDADES ASOIADAS ////////////////////////////
var actSelect = function (control) {
    console.log('actSelect');
    console.log("CONTROL: " + control);

    $.get("http://127.0.0.1:8000/api/cargar_actSelect/" + control, function (data1) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datosControl:data1', data1);
        $("#actividad").empty();
        $("#actividad").append("<option selected value='0' disabled='disabled' > Actividad </option>");
        if (data1 && data1.length > 0) {// Verificar que no esta vacia "data"
            data1.forEach(function (valor) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
                
                var idioma = document.getElementById("idioma").value;
                console.log("idioma: " + idioma);
                
                if (idioma == "es") {
                    $("#actividad").append("<option id='actividad' value='" + valor.act_id + "'>" + valor.act_nombre_es + "</option>");

                } else {
                    if(idioma == "en") {
                        $("#actividad").append("<option id='actividad' value='" + valor.act_id + "'>" + valor.act_nombre_en + "</option>");

                    }
                }

            });
        } else {// Si el array "data" recibido esta vacia
            $("#actividad").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
    console.log("?");
}
var actControl = function (act_id) {
    console.log('actControl');
    console.log("ACTIVIDAD: " + act_id);

    $.get("http://127.0.0.1:8000/api/cargar_actControl/" + act_id, function (data1) {// Se direcciona a la url especificada (api.php)
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
                document.getElementById("boton_modificar_actividad").disabled = false; // habilitar boton al llenar campos del formulario   

            });
        } else {// Si el array "data" recibido esta vacia
            $("#actividad").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
}
















//////////////////////////////////////////////////
var domSelected = function (dominio) {
    console.log('domSelected');
    console.log(dominio);

    var arrayProcEs = [];
    var arrayProcEn = [];

    var idioma = document.getElementById("idioma").value;


    $.get("http://127.0.0.1:8000/api/cargar_datosFiltroDominio/" + dominio, function (data) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datosProc:data', data);

        if (data && data.length > 0) {// Verificar que no esta vacia "data"
            data.forEach(function (valor) { // El método forEach() ejecuta la función 
                arrayProcEs.push(valor.proc_nombre_es);
                arrayProcEn.push(valor.proc_nombre_en);
            });

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

            document.getElementById("subp_id_filtro").disabled = false; // habilitar boton al llenar campos del formulario
            $("#subp_id_filtro").empty();

            if (idioma == "es") {
                $("#subp_id_filtro").append('<option selected value="0" disabled="disabled" > Subproceso </option>');
                data.forEach(function (valor) {
                    $("#subp_id_filtro").append('<option value="' + valor.subp_id + '">' + valor.subp_nombre_es + '</option>');
                });
            } else {
                if (idioma == "en") {
                    $("#subp_id_filtro").append('<option selected value="0" disabled="disabled" > Subproceso </option>');
                    data.forEach(function (valor) {
                        $("#subp_id_filtro").append('<option value="' + valor.subp_id + '">' + valor.subp_nombre_es + '</option>');
                    });
                }
            }

        } else {// Si el array "data" recibido esta vacia
            $(".col-md-6").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
}











//////////////////////////////////////////////////
var subpSelected = function (subp) {
    console.log('procSelected');
    console.log(subp);

    var idioma = document.getElementById("idioma").value;


    $.get("http://127.0.0.1:8000/api/cargar_datosFiltroSubp/" + subp, function (data) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datosProc:data', data);

        if (data && data.length > 0) {// Verificar que no esta vacia "data"

            document.getElementById("riesgo").disabled = false; // habilitar boton al llenar campos del formulario
            $("#riesgo").empty();

            if (idioma == "es") {
                $("#riesgo").append('<option selected value="0" disabled="disabled" > Riesgo </option>');
                data.forEach(function (valor) {
                    $("#riesgo").append('<option value="' + valor.rgo_id + '">' + valor.rgo_nombre_es + '</option>');
                });
            } else {
                if (idioma == "en") {
                    $("#riesgo").append('<option selected value="0" disabled="disabled" > Risk </option>');
                    data.forEach(function (valor) {
                        $("#riesgo").append('<option value="' + valor.rgo_id + '">' + valor.rgo_nombre_en + '</option>');
                    });
                }
            }

        } else {// Si el array "data" recibido esta vacia
            $(".col-md-6").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
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
                // actSelect(valor.cont_id);

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






// //////////////////// Bloquear Boton al enviar formulario
var checkSubmit_alta = function () {
    document.getElementById("boton_alta").value = "Enviando...";
    document.getElementById("boton_alta").disabled = true;
    return true;
}

// //////////////////// Bloquear Boton al enviar formulario
var checkSubmit_alta_dom = function () {
    document.getElementById("boton_modificar_control").value = "Enviando...";
    document.getElementById("boton_modificar_control").disabled = true;
    return true;
}


// //////////////////// Bloquear Boton al enviar formulario
var checkSubmit_alta_dom = function () {
    document.getElementById("boton_modificar_actividad").value = "Enviando...";
    document.getElementById("boton_modificar_actividad").disabled = true;
    return true;
}

// //////////////////// Bloquear Boton al enviar formulario
var checkSubmit_modificar = function () {
    document.getElementById("boton_modificar").value = "Enviando...";
    document.getElementById("boton_modificar").disabled = true;
    return true;
}