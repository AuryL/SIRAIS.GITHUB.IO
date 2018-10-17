var validarProc = function () {

    var escribirNombreEs = document.getElementById("proc_nombre_es");
    var escribirNombreEn = document.getElementById("proc_nombre_en");
    var escribirDetallesEs = document.getElementById("proc_detalles_es");
    var escribirDetallesEn = document.getElementById("proc_detalles_en");


    console.log(escribirNombreEs.value);
    console.log(escribirNombreEn.value);
    console.log(escribirDetallesEs.value);
    console.log(escribirDetallesEn.value);

    var selectedDominioId = document.getElementById("dom_id");
    var dominioId = selectedDominioId.options[selectedDominioId.selectedIndex].text;

    if (dominioId == "Dominio" || dominioId == "Domain" ) {
        alert("Debes seleccionar un Domino")
        // return false
    }


    if (dominioId == "Dominio" || dominioId == "Domain" || escribirNombreEs.value == null || escribirNombreEn.value == null || escribirDetallesEs.value == null || escribirDetallesEn.value == null) {
        alert("Debes llenar todos los campos");
        
        return false
    } 
    // else {
    //     alert("Perfecto");
    // }
}




//////////////////////////////////////////////////
var procesoSelected = function (proceso) {
    console.log('procesoSelected');
    console.log(proceso);

    $.get("http://127.0.0.1:8000/api/cargar_datosProc/" + proceso, function (data) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('datosProc:data', data);

        if (data && data.length > 0) {// Verificar que no esta vacia "data"
            data.forEach(function (valor) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"

                document.getElementById("proc_id").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("proc_nombre_es").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("proc_nombre_en").disabled = false; // habilitar boton al llenar campos del formulario
                document.getElementById("proc_detalles_es").disabled = false; // habilitar boton al llenar campos del formulario 
                document.getElementById("proc_detalles_en").disabled = false; // habilitar boton al llenar campos del formulario  
                document.getElementById("proc_estado").disabled = false; // habilitar boton al llenar campos del formulario   
                document.getElementById("dom_id").disabled = false; // habilitar boton al llenar campos del formulario 

                document.getElementById("proc_id").value = valor.proc_id;
                document.getElementById("proc_nombre_es").value = valor.proc_nombre_es;
                document.getElementById("proc_nombre_en").value = valor.proc_nombre_en;
                document.getElementById("proc_detalles_es").value = valor.proc_detalles_es;
                document.getElementById("proc_detalles_en").value = valor.proc_detalles_en;
                document.getElementById("dom_id").value = valor.dom_id;


                console.log(document.getElementById("proc_id").value);
                console.log(document.getElementById("proc_nombre_es").value);
                console.log(document.getElementById("proc_nombre_en").value);
                console.log(document.getElementById("proc_detalles_es").value);
                console.log(document.getElementById("proc_detalles_en").value);
                console.log(document.getElementById("dom_id").value);


                if (valor.proc_estado == 1) { // Colocar el Estado del usuario con jquery
                    document.getElementsByName("proc_estado").value = 1;
                    $("#proc_estado").prop('checked', true);
                } else {
                    if (valor.proc_estado == 0) {
                        document.getElementsByName("proc_estado").value = 0;
                        $("#proc_estado").prop('checked', false);
                    }
                }

                document.getElementById("boton_modificar").disabled = false; // habilitar boton al llenar campos del formulario
            });

        } else {// Si el array "data" recibido esta vacia
            $(".col-md-6").append("<p>No se encontraron registros</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
}