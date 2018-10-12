$(document).ready(function () {
    $('#div_tree').jstree({// Funcion que permite colocar los checkbox en el arbol
        // "languages" : [ "en", "es" ],
        "plugins": ["checkbox"]
    });




    // $('#div_tree').on('changed.jstree', function (e, data) {
    //     console.log(data.node);
    // });




    /////////////////////////////////////////////////////////////////////////////////////////////
    /* ******  Parte de la funcion que va enlistando los controles y actividades que el usuario va seleccionando en el checkbox
    copia22_tree_270918 aun conserva el formato del tree.blade.php que necesita esta funcion para que funcione ******* */

    // $('#div_tree').on('changed.jstree', function (e, data) {
    //     var i, j, r = [], rCont = [], rAct = [];

    //     for (i = 0, j = data.selected.length; i < j; i++) {

    //         if (data.instance.get_node(data.selected[i]).li_attr.value != undefined) {
    //             rCont.push(data.instance.get_node(data.selected[i]).li_attr.name);
    //             console.log("rCont", rCont);
    //             rAct.push(data.instance.get_node(data.selected[i]).li_attr.value);
    //             console.log("rAct", rAct);
    //         }
    //     }
    //     rCont.forEach(function (rgo_id) {
    //         $.get("http://127.0.0.1:8000/api/addContr/" + rgo_id, function (data1) {// Se direcciona a la url especificada (api.php)
    //             // Posteriormente, recibe el resultado de la petición, que es data
    //             if (data1 && data1.length > 0) {// Verificar que no esta vacia "data"
    //                 data1.forEach(function (c) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
    //                     $("#div_controles").append('<p> - ' + c.cont_nombre_es + '</p>');// Se agrega un <p> en el elemento #div_actividades, por cada elemento del array "data"
    //                 });

    //             } else {// Si el array "data" recibido esta vacia
    //                 $("#div_controles").append("<p>No se encontraron controles</p>");// Se agrega un <p> señalando que no se encontraron controles
    //             }
    //         });
    //     });
    //     rAct.forEach(function (cont_id) {
    //         $.get("http://127.0.0.1:8000/api/addAct/" + cont_id, function (data1) {// Se direcciona a la url especificada (api.php)
    //             // Posteriormente, recibe el resultado de la petición, que es data
    //             if (data1 && data1.length > 0) {// Verificar que no esta vacia "data"
    //                 data1.forEach(function (a) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
    //                     $("#div_actividades").append('<p> - ' + a.act_nombre_es + '</p>');// Se agrega un <p> en el elemento #div_actividades, por cada elemento del array "data"
    //                 });
    //             } else {// Si el array "data" recibido esta vacia
    //                 $("#div_actividades").append("<p>No se encontraron actividades</p>");// Se agrega un <p> señalando que no se encontraron controles
    //             }
    //         });
    //     });
    //     $("#div_controles").empty();// Elimina el contenido del elemento #div_actividades
    //     $("#div_actividades").empty();// Elimina el contenido del elemento #div_actividades
    // })




    // $("#espaniol").click(function () {

    //     document.getElementById("dom_id").value = valor.dom_id;
    //     document.getElementById("dom_nombre_es").value = valor.dom_nombre_es;
    //     document.getElementById("dom_nombre_en").value = valor.dom_nombre_en;
    //     document.getElementById("dom_detalles_es").value = valor.dom_detalles_es;
    //     document.getElementById("dom_detalles_en").value = valor.dom_detalles_en;

    // });


    //////////////////////////////// TRATANDO DE LLENAR TABLA DE PORCENTAJES Y TABLA DE VISTA PREVIA /////////////////
    $('#div_tree').on('changed.jstree', function (e, data) {
        var i, j, r = [];
        console.log(data);
        for (i = 0, j = data.selected.length; i < j; i++) {

            if (data.selected[i].parent == "#") {
                r.push(data.instance.get_node(data.selected[i]).text);
            }
        }
        console.log(r);

        ///////////////// PARTE DE LA FUNCION QUE PERMITE LLENAR LA TABLA DE VISTA PREVIA DEL EXCEL, EN LA VISTA DEL TREE
        // Inicializar arrays 
        var jsonArray = [];
        var arrayParents = [];
        var arrayInvertir = [];
        var arrayArrays = [];
        // Se obtienen los elementos seleccionados(checkbox) del arbol tree en tree.blade.php
        // Se guarda en el arreglo "arrayElemSelected"
        var arrayElemSelected = $("#div_tree").jstree("get_selected", true);

        for (let i in arrayElemSelected) { // Recorremos el arreglo(arrayElemSelected) que tiene los elementos de los checkbox seleccionados
            if (arrayElemSelected[i].children == "") { // Se hace un filtro del arreglo, para saber cuál es la útima rama, 
                // si el elemento children es vacio, quiere decir que ya no tiene hijos, por lo que es él el ultimo hijo(rama)
                arrayParents = arrayElemSelected[i].parents; // arrayParents: Array en donde se guardan las ramas padre de la ultima rama(ultimo hijo)
                // arrayElemSelected[i].parents es un array de los id de los padres de la ultima rama.

                for (let j in arrayParents) { // Se recorre el array de los padres(arrayElemSelected)
                    if (arrayParents[j] != "#") { // Se hace un filtro, el id=# quiere decir que es la rama de riesgos, en la que nos encontramos, la ultima rama

                        // get_node (obj [, as_dom]): obtener la representación JSON de un nodo (o el nodo DOM 
                        // extendido de jQuery real) mediante el uso de cualquier entrada (elemento DOM doméstico, cadena ID, selector, etc.)
                        // Con la funcion text - Se obtiene el texto de los padresy del hijo.
                        var textParents = $('#div_tree').jstree(true).get_node(arrayParents[j]).text;
                        var textChildren = $('#div_tree').jstree(true).get_node(arrayElemSelected[i]).text;

                        // El JSON de los nodos padres, obtenido anteriormente, se coloca en un array
                        arrayInvertir.push(textParents);
                    }
                }
                arrayInvertir.reverse(); // Se invierte el array para que los elementos esten ordenados. (dominio, proceso, subproceso)
                arrayInvertir.push(textChildren); // ya ordenados los elementos del array, se inserta el ultimo elemento: riesgo - la ultima rama.(dominio, proceso, subproceso, riesgo)
                console.log("arrayInvertir", arrayInvertir);

                arrayArrays.push(arrayInvertir); // Ahora se agrega, en otro array(arrayArrays), cada arreglo que se vaya generando
                arrayInvertir = [];// Se limpia el array que guardó los padres del children actual.
            }
        }
        console.log('arrayArrays', arrayArrays);





        ///////////////////////////////////
        // Arrays que guardarán los elemento seleccionados en el tree, dependiendo el nivel en el que se encuentran en este tree.
        var dominiosArray = [];
        var procesosArray = [];
        var subprocesosArray = [];
        var riesgosArray = [];
        var controlesArray = [];
        var actividadesArray = [];
        // Arrays que guardarán los registros de dominios, procesos, subprocesos, riesgos, controles y actividades obtenidos de la DB
        var dominiosTotales = [];
        var procesosTotales = [];
        var subprocesosTotales = [];
        var riesgosTotales = [];
        var controlesTotales = [];
        var actividadesTotales = [];
        // Arrays que guardarán los elemento seleccionados en el tree (Ya sin estar repetidos), dependiendo el nivel en el que se encuentran en este tree.
        var dominiosSinDuplicar = [];
        var procesoSinDuplicar = [];
        var subprocesosSinDuplicar = [];
        var riesgosSinDuplicar = [];
        var controlesSinDuplicar = [];
        var actividadesSinDuplicar = [];


        for (let j in arrayArrays) {
            dominiosArray.push(arrayArrays[j][0]);
            procesosArray.push(arrayArrays[j][1]);
            subprocesosArray.push(arrayArrays[j][2]);
            riesgosArray.push(arrayArrays[j][3]);
            controlesArray.push(arrayArrays[j][4]);
            actividadesArray.push(arrayArrays[j][5]);
        }
        // console.log("dominiosArray", dominiosArray);
        // console.log("procesosArray", procesosArray);
        // console.log("subprocesosArray", subprocesosArray);
        // console.log("riesgosArray", riesgosArray);
        // console.log("controlesArray", controlesArray);
        // console.log("actividadesArray", actividadesArray);

        // Se obtenen todos los registros de los diminios, proceso, subproceso, riesgos, controes y actividades
        $.get("http://127.0.0.1:8000/api/cargar_allElementsTree/", function (data) { // Se direcciona a la url especificada (api.php)
            // Posteriormente, recibe el resultado de la petición, que es data
            console.log('cargar_allElementsTree:data', data);
            $("#dominio").empty();
            $("#proceso").empty();
            $("#subproceso").empty();
            $("#riesgo").empty();
            $("#control").empty();
            $("#actividad").empty();

            if (data && data.length > 0) { // Verificar que no esta vacia "data"
                // Lleamos los array con la informacion obtenida de la DB

                var idioma = document.getElementById("idioma").value;
                console.log(idioma);
                if (idioma == "es") {
                    // document.getElementById("dominio");
                    for (let j in data[0]) {
                        dominiosTotales.push(data[0][j].dom_nombre_es);
                    }
                    for (let j in data[1]) {
                        procesosTotales.push(data[1][j].proc_nombre_es);
                    }
                    for (let j in data[2]) {
                        subprocesosTotales.push(data[2][j].subp_nombre_es);
                    }
                    for (let j in data[3]) {
                        riesgosTotales.push(data[3][j].rgo_nombre_es);
                    }
                    for (let j in data[4]) {
                        controlesTotales.push(data[4][j].cont_nombre_es);
                    }
                    for (let j in data[5]) {
                        actividadesTotales.push(data[5][j].act_nombre_es);
                    }
                } else {
                    if (idioma == "en") {
                        for (let j in data[0]) {
                            dominiosTotales.push(data[0][j].dom_nombre_en);
                        }
                        for (let j in data[1]) {
                            procesosTotales.push(data[1][j].proc_nombre_en);
                        }
                        for (let j in data[2]) {
                            subprocesosTotales.push(data[2][j].subp_nombre_en);
                        }
                        for (let j in data[3]) {
                            riesgosTotales.push(data[3][j].rgo_nombre_en);
                        }
                        for (let j in data[4]) {
                            controlesTotales.push(data[4][j].cont_nombre_en);
                        }
                        for (let j in data[5]) {
                            actividadesTotales.push(data[5][j].act_nombre_en);
                        }
                    }
                }
                console.log("dominiosTotales", dominiosTotales);
                console.log("procesosTotales", procesosTotales);
                console.log("subprocesosTotales", subprocesosTotales);
                console.log("riesgosTotales", riesgosTotales);
                console.log("controlesTotales", controlesTotales);
                console.log("actividadesTotales", actividadesTotales);


                ///////////////////// Se eliminan todos los elementos que esten duplicados en cada array que se obtuvo de los checkbox seleccionados
                var dominiosSinDuplicar = eliminateDuplicates(dominiosArray);
                var procesosSinDuplicar = eliminateDuplicates(procesosArray);
                var subprocesosSinDuplicar = eliminateDuplicates(subprocesosArray);
                var riesgosSinDuplicar = eliminateDuplicates(riesgosArray);
                var controlesSinDuplicar = eliminateDuplicates(controlesArray);
                var actividadesSinDuplicar = eliminateDuplicates(actividadesArray);
                console.log("dominiosSinDuplicar", dominiosSinDuplicar);
                console.log("procesosSinDuplicar", procesosSinDuplicar);
                console.log("subprocesosSinDuplicar", subprocesosSinDuplicar);
                console.log("driesgosSinDuplicar", riesgosSinDuplicar);
                console.log("controlesSinDuplicar", controlesSinDuplicar);
                console.log("actividadesSinDuplicar", actividadesSinDuplicar);



                ////////////////////// Se calcula el promedio con los elementos totales y los elementos seleccionados en el tree, segun sea el caso
                var numeroDouble = (dominiosSinDuplicar.length * 100) / dominiosTotales.length;
                var porcentajeDominios = numeroDouble.toFixed(2);

                numeroDouble = (procesosSinDuplicar.length * 100) / procesosTotales.length;
                var porcentajeProcesos = numeroDouble.toFixed(2);

                numeroDouble = (subprocesosSinDuplicar.length * 100) / subprocesosTotales.length;
                var porcentajeSubprocesos = numeroDouble.toFixed(2);

                numeroDouble = (riesgosSinDuplicar.length * 100) / riesgosTotales.length;
                var porcentajeRiesgos = numeroDouble.toFixed(2);

                numeroDouble = (controlesSinDuplicar.length * 100) / controlesTotales.length;
                var porcentajeControles = numeroDouble.toFixed(2);

                numeroDouble = (actividadesSinDuplicar.length * 100) / actividadesTotales.length;
                var porcentajeActividades = numeroDouble.toFixed(2);


                if (idioma == "es") {
                    $("#dominio").append("<td class='td_body'<strong>Dominio</strong></td><td class='td_body' id='total'>" + dominiosTotales.length + "</td><td class='td_body' id='seleccionados'>" + dominiosSinDuplicar.length + "</td><td class='td_body' id='porcentaje'>" + porcentajeDominios + "% </td>");
                    $("#proceso").append("<td class='td_body'>Proceso</td><td class='td_body' id='total'>" + procesosTotales.length + "</td><td class='td_body' id='seleccionados'>" + procesosSinDuplicar.length + "</td><td class='td_body' id='porcentaje'>" + porcentajeProcesos + "% </td>");
                    $("#subproceso").append("<td class='td_body'>Subproceso</td><td class='td_body' id='total'>" + subprocesosTotales.length + "</td><td class='td_body' id='seleccionados'>" + subprocesosSinDuplicar.length + "</td><td class='td_body' id='porcentaje'>" + porcentajeSubprocesos + "% </td>");
                    $("#riesgo").append("<td class='td_body'>Riesgo</td><td class='td_body' id='total'>" + riesgosTotales.length + "</td><td class='td_body' id='seleccionados'>" + riesgosSinDuplicar.length + "</td><td class='td_body' id='porcentaje'>" + porcentajeRiesgos + "% </td>");
                    $("#control").append("<td class='td_body'>Control</td><td class='td_body' id='total'>" + controlesTotales.length + "</td><td class='td_body' id='seleccionados'>" + controlesSinDuplicar.length + "</td><td class='td_body' id='porcentaje'>" + porcentajeControles + "% </td>");
                    $("#actividad").append("<td class='td_body'>Actividad</td><td class='td_body' id='total'>" + actividadesTotales.length + "</td><td class='td_body' id='seleccionados'>" + actividadesSinDuplicar.length + "</td><td class='td_body' id='porcentaje'>" + porcentajeActividades + "% </td>");

                } else {
                    if (idioma == "en") {
                        $("#dominio").append("<td class='td_body'>Domain</td><td class='td_body' id='total'>" + dominiosTotales.length + "</td><td class='td_body' id='seleccionados'>" + dominiosSinDuplicar.length + "</td><td class='td_body' id='porcentaje'>" + porcentajeDominios + "% </td>");
                        $("#proceso").append("<td class='td_body'>Process</td><td class='td_body' id='total'>" + procesosTotales.length + "</td><td class='td_body' id='seleccionados'>" + procesosSinDuplicar.length + "</td><td class='td_body' id='porcentaje'>" + porcentajeProcesos + "% </td>");
                        $("#subproceso").append("<td class='td_body'>Subprocess</td><td class='td_body' id='total'>" + subprocesosTotales.length + "</td><td class='td_body' id='seleccionados'>" + subprocesosSinDuplicar.length + "</td><td class='td_body' id='porcentaje'>" + porcentajeSubprocesos + "% </td>");
                        $("#riesgo").append("<td class='td_body'>Risk</td><td class='td_body' id='total'>" + riesgosTotales.length + "</td><td class='td_body' id='seleccionados'>" + riesgosSinDuplicar.length + "</td><td class='td_body' id='porcentaje'>" + porcentajeRiesgos + "% </td>");
                        $("#control").append("<td class='td_body'>Control</td><td class='td_body' id='total'>" + controlesTotales.length + "</td><td class='td_body' id='seleccionados'>" + controlesSinDuplicar.length + "</td><td class='td_body' id='porcentaje'>" + porcentajeControles + "% </td>");
                        $("#actividad").append("<td class='td_body'>Activity</td><td class='td_body' id='total'>" + actividadesTotales.length + "</td><td class='td_body' id='seleccionados'>" + actividadesSinDuplicar.length + "</td><td class='td_body' id='porcentaje'>" + porcentajeActividades + "% </td>");
                    }
                }


            } else { // Si el array "data" recibido esta vacia
                $("#div_actividades").append("<p>No se encontraron actividades</p>"); // Se agrega un <p> señalando que no se encontraron actividades
            }
        });


        /////// SE AGREGA A LA TABLA LAS FILAS CORRESPONDIENTES A LOS CHECKBOX SELECCIONADOS, LLENANDO LA TABLA ///////
        $(".cuerpo_tabla_vistaPrevia").empty(); // cada vez que se seleccione un nuevo checkbox, se limpia la tabla y se recarga con los datos de los todos los checkbox seleccionados
        for (let j in arrayArrays) {
            $(".cuerpo_tabla_vistaPrevia").append('<tr><td class="td_body">' + arrayArrays[j][0] + '</td><td class="td_body">' + arrayArrays[j][1] + '</td><td class="td_body">' + arrayArrays[j][2] + '</td><td class="td_body">' + arrayArrays[j][3] + '</td><td class="td_body">' + arrayArrays[j][4] + '</td><td class="td_body">' + arrayArrays[j][5] + '</td></tr>');
        }
    })
});
///////////////////////////// FUNCION QUE ELIMINA LOS ELEMENTOS DUPLICADOS EN UN ARRAY, 
// Esta funcion es usada aqui arriba
var eliminateDuplicates = function (arr) {
    var i,
        len = arr.length,
        out = [],
        obj = {};

    for (i = 0; i < len; i++) {
        obj[arr[i]] = 0;
    }
    for (i in obj) {
        out.push(i);
    }
    return out;
}







////////////////////////// Funcion que genera un EXCEL con base a los checkbox seleccionados en el tree.blade.php ////////////////////////////
var generarExcel = function () {
    console.log('generarExcel');

    // Inicializar arrays 
    var jsonArray = [];
    var arrayParents = [];
    var arrayInvertir = [];
    var arrayArrays = [];
    // Se obtienen los elementos seleccionados(checkbox) del arbol tree en tree.blade.php
    // Se guarda en el arreglo "arrayElemSelected"
    var arrayElemSelected = $("#div_tree").jstree("get_selected", true);

    for (let i in arrayElemSelected) { // Recorremos el arreglo(arrayElemSelected) que tiene los elementos de los checkbox seleccionados
        if (arrayElemSelected[i].children == "") { // Se hace un filtro del arreglo, para saber cuál es la útima rama, 
            // si el elemento children es vacio, quiere decir que ya no tiene hijos, por lo que es él el ultimo hijo(rama)
            arrayParents = arrayElemSelected[i].parents; // arrayParents: Array en donde se guardan las ramas padre de la ultima rama(ultimo hijo)
            // arrayElemSelected[i].parents es un array de los id de los padres de la ultima rama.

            for (let j in arrayParents) { // Se recorre el array de los padres(arrayElemSelected)
                if (arrayParents[j] != "#") { // Se hace un filtro, el id=# quiere decir que es la rama de riesgos, en la que nos encontramos, la ultima rama


                    // get_node (obj [, as_dom]): obtener la representación JSON de un nodo (o el nodo DOM 
                    // extendido de jQuery real) mediante el uso de cualquier entrada (elemento DOM doméstico, cadena ID, selector, etc.)
                    // Con la funcion text - Se obtiene el texto de los padresy del hijo.
                    var textParents = $('#div_tree').jstree(true).get_node(arrayParents[j]).text;
                    var textChildren = $('#div_tree').jstree(true).get_node(arrayElemSelected[i]).text;

                    // El JSON de los nodos padres, obtenido anteriormente, se coloca en un array
                    arrayInvertir.push(textParents);
                }
            }
            arrayInvertir.reverse(); // Se invierte el array para que los elementos esten ordenados. (dominio, proceso, subproceso)
            arrayInvertir.push(textChildren); // ya ordenados los elementos del array, se inserta el ultimo elemento: riesgo - la ultima rama.(dominio, proceso, subproceso, riesgo)

            arrayArrays.push(arrayInvertir); // Ahora se agrega, en otro array(arrayArrays), cada arreglo que se vaya generando
            arrayInvertir = [];// Se limpia el array que guardó los padres del children actual.
        }
    }
    console.log('arrayArrays', arrayArrays);

    //
    let xhr = new XMLHttpRequest();

    // open (método, url): Realiza una petición de apertura de comunicación con un método que puede ser principalmente GET o POST.
    // METODO: 
    /* Con GET los parámetros de la petición van incluidos en la url. 
       Con POST los parámetros de la petición van en las cabeceras de HTTP. */
    // URL: Puede ser una ruta relativa o completa.
    // xmlhttp.open("GET","datos.php?pais=spain");
    xhr.open('POST', 'http://127.0.0.1:8000/api/treeexcel'); // Se direcciona a la url especificada (api.php)
    xhr.setRequestHeader('Content-Type', 'application/json');// Para PUBLICAR datos como un formulario HTML, agregue un encabezado 
    // HTTP con setRequestHeader (). Especifique los datos que desea enviar en el método send ():
    // Agrega encabezados HTTP a la solicitud

    // encabezado: especifica el nombre del encabezado
    // valor: especifica el valor del encabezado
    /* Agrega un par de label/value al encabezado que se enviará*/

    xhr.responseType = 'blob'; //responseType: es un valor de cadena enumerado que especifica el tipo de datos contenidos en la respuesta.
    // blob: Los blobs son objetos inmutables que representan datos brutos. File es una derivación de Blob que representa datos 
    // del sistema de archivos. Use FileReader para leer datos de una Blob o archivo. Blobs te permite construir archivos como
    //  objetos en el cliente que puedes pasar a apis que esperan urls en lugar de requerir que el servidor proporcione el archivo. 
    // Por ejemplo, puede construir un blob que contenga los datos de una imagen,

    xhr.onload = function (e) { //  XMLHttpRequest.onload = callback;
        // callback: es la función que se ejecutará cuando la solicitud se complete con éxito. 
        // Recibe un objeto ProgressEvent como primer argumento. 

        if (this.status == 200) { // Si el estatus de la solicitud 200: "OK"
            let link = document.createElement('a'); // Se crea un elemento link <a>
            link.href = window.URL.createObjectURL(this.response); // Se le agrega un atributo href al <a> creado
            // this.response: Devuelve los datos de respuesta
            link.download = "results.xlsx";
            link.click();
        }
        else {
            console.log('xhr error');
        }
    }

    // xhr.send(JSON.stringify({ riesgos: arrayArrays }));
    // xhr.send(JSON.stringify({ controls: arrayArrays }));
    xhr.send(JSON.stringify({ actividads: arrayArrays }));
}








////////////////////////// Funcion que muestra solo el control y la actividad que selecciona el usuario en el momento ////////////////////////////
var cargarActividadesYControles = function (rgo_id) {
    console.log('cargarActividades');
    /////////////////////////// ACTIVIDADES ///////////////////////////
    /* 
        Método $.get(URL, CALLBACK); de jQuery
        * El método $.get() solicia información a un servidor con la petición HTTP GET.
        * sirve para hacer una solicitud Ajax al servidor en la que podemos enviar datos por el método GET.
    */
    // $.get(URL, funcion) -- PARAMETROS
    // - URL: es necesario y es donde se especifica la URL a la cual quieres mandar tu petición.
    // - FUNCION: El CALLBACK es opcional y es el nombre de la función que se ejecutará una vez que la petición concluya satisfactoriamente. 
    // En esa función a su vez recibimos varios parámetros, siendo el más importante el primero, en el que 
    // tendremos una referencia al resultado de la solicitud realizada.
    $.get("http://127.0.0.1:8000/api/cargar_actividades/" + rgo_id, function (data) { // Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('actividades:data', data);
        $("#div_actividades").empty(); // Elimina el contenido del elemento #div_actividades
        if (data && data.length > 0) { // Verificar que no esta vacia "data"
            data.forEach(function (a) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
                $("#div_actividades").append('<p>' + a.act_nombre_es + '</p>'); // Se agrega un <p> en el elemento #div_actividades, por cada elemento del array "data"
            });
        } else { // Si el array "data" recibido esta vacia
            $("#div_actividades").append("<p>No se encontraron actividades</p>"); // Se agrega un <p> señalando que no se encontraron actividades
        }
    });
    /////////////////////////// CONTROLES ///////////////////////////
    /* 
        Método $.get(URL, CALLBACK); de jQuery
        * El método $.get() solicia información a un servidor con la petición HTTP GET.
        * sirve para hacer una solicitud Ajax al servidor en la que podemos enviar datos por el método GET.
    */
    // $.get(URL, funcion) -- PARAMETROS
    // - URL: es necesario y es donde se especifica la URL a la cual quieres mandar tu petición.
    // - FUNCION: El CALLBACK es opcional y es el nombre de la función que se ejecutará una vez que la petición concluya satisfactoriamente. 
    // En esa función a su vez recibimos varios parámetros, siendo el más importante el primero, en el que 
    // tendremos una referencia al resultado de la solicitud realizada.
    $.get("http://127.0.0.1:8000/api/cargar_controles/" + rgo_id, function (data) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('controles:data', data);
        $("#div_controles").empty();// Elimina el contenido del elemento #div_controles
        if (data && data.length > 0) {// Verificar que no esta vacia "data"
            data.forEach(function (a) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
                $("#div_controles").append('<p>' + a.cont_nombre_es + '</p>');// Se agrega un <p> en el elemento #div_controles, por cada elemento del array "data"
            });
        } else {// Si el array "data" recibido esta vacia
            $("#div_controles").append("<p>No se encontraron controles</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
}









////////////////////////// Funcion que muestra solo el control y la actividad (en una tala) que le da click el usuario en el momento en el nombre del Control////////////////////////////
var cargarActividadesYControlesAlClick = function (rgo_id, cont_id) {
    console.log('cargarActividades');
    console.log("rgo_id: " + rgo_id);
    console.log("cont_id: " + cont_id);
    var idioma = document.getElementById("idioma").value;

    /////////////////////////// CONTROLES ///////////////////////////
    $.get("http://127.0.0.1:8000/api/cargar_controles/" + rgo_id, function (data) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('controles:data', data);
        // $(".cuerpo_tabla").empty();// Elimina el contenido del elemento .cuerpo_tabla
        $("#div_controles").empty();// Elimina el contenido del elemento #div_controles
        if (data && data.length > 0) {// Verificar que no esta vacia "data"
            data.forEach(function (a) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
                // $(".cuerpo_tabla").append('<tr><td class="td_body">' + a.cont_nombre_es + '</td><td class="td_body">' + a.cont_detalles_es + '</td></tr>');
                if (idioma == "es") {
                    $("#div_controles").append("<table class='tabla_controles' border='1'><thead class='cabecera_tabla'><tr><td class='td_cabecera'>Objetivo</td><td class='td_cabecera'>Detalles</td></tr></thead><tbody class='cuerpo_tabla'><tr><td class='td_body'>" + a.cont_nombre_es + "</td><td class='td_body'>" + a.cont_detalles_es + "</td></tr></tbody></table><h6><strong>ACTIVIDADES ASOCIADAS</strong></h6><div id='div_actividades'></div>");
                } else {
                    if (idioma == "en") {
                        $("#div_controles").append("<table class='tabla_controles' border='1'><thead class='cabecera_tabla'><tr><td class='td_cabecera'>Objective</td><td class='td_cabecera'>Details</td></tr></thead><tbody class='cuerpo_tabla'><tr><td class='td_body'>" + a.cont_nombre_en + "</td><td class='td_body'>" + a.cont_detalles_en + "</td></tr></tbody></table><h6><strong>ASSOCIATED ACTIVITIES</strong></h6><div id='div_actividades'></div>");
                    }
                }
            });
        } else {// Si el array "data" recibido esta vacia
            $(".cuerpo_tabla").append("<p>No se encontraron controles</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
    $("#div_controles").empty();// Elimina el contenido del elemento #div_controles
    /////////////////////////// ACTIVIDADES ///////////////////////////
    $.get("http://127.0.0.1:8000/api/cargar_actividades/" + cont_id, function (data) { // Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('actividades:data', data);
        $("#div_actividades").empty(); // Elimina el contenido del elemento #div_actividades
        if (data && data.length > 0) { // Verificar que no esta vacia "data"
            data.forEach(function (a) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"

                if (idioma == "es") {
                    $("#div_actividades").append('<p>' + a.act_nombre_es + '</p>'); // Se agrega un <p> en el elemento #div_actividades, por cada elemento del array "data"
                } else {
                    if (idioma == "en") {
                        $("#div_actividades").append('<p>' + a.act_nombre_en + '</p>'); // Se agrega un <p> en el elemento #div_actividades, por cada elemento del array "data"                    }
                    }
                }

            });
        } else { // Si el array "data" recibido esta vacia
            $("#div_actividades").append("<p>No se encontraron actividades</p>"); // Se agrega un <p> señalando que no se encontraron actividades
        }
    }); $("#div_controles").empty();// Elimina el contenido del elemento #div_controles

}








/////////////////////// Funcion para mostrar todos los Controles y Actividades que se van seleccionando ////////////////////////////
var globalContr = "";
var gaglobalActiv = "";
//  evento al dar clic en riesgo del arbol
function prueba(rgo_id) {
    // CONTROLES
    $.get("http://127.0.0.1:8000/api/addContr/" + rgo_id, function (data) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('controles:data', data);
        $("#div_controles").empty();// Elimina el contenido del elemento #div_controles
        if (data && data.length > 0) {// Verificar que no esta vacia "data"
            data.forEach(function (a) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
                globalContr = globalContr + "<br>" + "\n" + " -> " + a.cont_nombre_es;
                console.log(globalContr);
                $("#div_controles").append('<p>' + globalContr + '</p>');// Se agrega un <p> en el elemento #div_controles, por cada elemento del array "data"
            });
        } else {// Si el array "data" recibido esta vacia
            $("#div_controles").append("<p>No se encontraron controles</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
    // ACTIVIDADES
    $.get("http://127.0.0.1:8000/api/addAct/" + rgo_id, function (data) {// Se direcciona a la url especificada (api.php)
        // Posteriormente, recibe el resultado de la petición, que es data
        console.log('actividades:data', data);
        $("#div_actividades").empty();// Elimina el contenido del elemento #div_actividades
        if (data && data.length > 0) {// Verificar que no esta vacia "data"
            data.forEach(function (a) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
                globalActiv = globalActiv + "<br>" + "\n" + " -> " + a.act_nombre_es;
                console.log(globalActiv);
                $("#div_actividades").append('<p>' + globalActiv + '</p>');// Se agrega un <p> en el elemento #div_actividades, por cada elemento del array "data"
            });
        } else {// Si el array "data" recibido esta vacia
            $("#div_actividades").append("<p>No se encontraron actividades</p>");// Se agrega un <p> señalando que no se encontraron controles
        }
    });
}







// ///////////////////////// Funcion para mostrar todos los Controles y Actividades que se van seleccionando ////////////////////////////
// var gc = "";
// var ga = "";
// // Al dar clic en riesgo del arbol, se genera un evento que usa la funcion prubeba2
// function prueba2(rgo_id) {
//     //////////////// CONTROLES ///////////////
//     $.get("http://127.0.0.1:8000/api/addContr/" + rgo_id, function (value) {// Se direcciona a la url especificada (api.php)

//         $("#div_controles").empty();// Elimina el contenido del elemento #div_controles
//         var arrayElemSelected = $("#div_tree").jstree("get_selected", true);
//         for (let i in arrayElemSelected) { // Recorremos el arreglo(arrayElemSelected) que tiene los elementos de los checkbox seleccionados
//             console.log(arrayElemSelected[i]);
//             if (arrayElemSelected[i].children == "") { // Se hace un filtro del arreglo, para saber cuál es la útima rama, 
//                 var textChildren = $('#div_tree').jstree(true).get_node(arrayElemSelected[i]).text;
//                 console.log(textChildren);
//                 console.log(arrayElemSelected[i].li_attr.value);
//                 if (arrayElemSelected[i].state.selected == true) {
//                     var riesgoId = arrayElemSelected[i].li_attr.value;
//                     $.get("http://127.0.0.1:8000/api/addContr/" + riesgoId, function (data) {// Se direcciona a la url especificada (api.php)
//                         // Posteriormente, recibe el resultado de la petición, que es data
//                         console.log('controles:data', data);
//                         $("#div_controles").empty();// Elimina el contenido del elemento #div_controles
//                         if (data && data.length > 0) {// Verificar que no esta vacia "data"
//                             data.forEach(function (c) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
//                                 gc = gc + "\n" + " -> " + c.cont_nombre_es + "<br>";
//                                 console.log(gc);
//                                 $("#div_controles").append('<p>' + gc + '</p>');// Se agrega un <p> en el elemento #div_controles, por cada elemento del array "data"
//                             });
//                         } else {// Si el array "data" recibido esta vacia
//                             $("#div_controles").append("<p>No se encontraron Controles</p>");// Se agrega un <p> señalando que no se encontraron controles
//                         }
//                     });
//                 }
//             }
//             gc = "";
//         }
//         gc = "";
//     });
//     //////////////// ACTIVIDADES ///////////////
//     $.get("http://127.0.0.1:8000/api/addAct/" + rgo_id, function (value) {// Se direcciona a la url especificada (api.php)
//         $("#div_actividades").empty();// Elimina el contenido del elemento #div_actividades
//         var arrayElemSelected = $("#div_tree").jstree("get_selected", true);
//         for (let i in arrayElemSelected) { // Recorremos el arreglo(arrayElemSelected) que tiene los elementos de los checkbox seleccionados
//             console.log(arrayElemSelected[i]);
//             if (arrayElemSelected[i].children == "") { // Se hace un filtro del arreglo, para saber cuál es la útima rama, 
//                 var textChildren = $('#div_tree').jstree(true).get_node(arrayElemSelected[i]).text;
//                 console.log(textChildren);
//                 console.log(arrayElemSelected[i].li_attr.value);
//                 if (arrayElemSelected[i].state.selected == true) {
//                     var riesgoId = arrayElemSelected[i].li_attr.value;
//                     $.get("http://127.0.0.1:8000/api/addAct/" + riesgoId, function (data) {// Se direcciona a la url especificada (api.php)
//                         // Posteriormente, recibe el resultado de la petición, que es data
//                         console.log('actividades:data', data);
//                         $("#div_actividades").empty();// Elimina el contenido del elemento #div_actividades
//                         if (data && data.length > 0) {// Verificar que no esta vacia "data"
//                             data.forEach(function (a) { // El método forEach() ejecuta la función indicada una vez por cada elemento "a" del array "data"
//                                 ga = ga + "\n" + " -> " + a.act_nombre_es + "<br>";
//                                 console.log(ga);
//                                 $("#div_actividades").append('<p>' + ga + '</p>');// Se agrega un <p> en el elemento #div_actividades, por cada elemento del array "data"
//                             });
//                         } else {// Si el array "data" recibido esta vacia
//                             $("#div_actividades").append("<p>No se encontraron actividades</p>");// Se agrega un <p> señalando que no se encontraron controles
//                         }
//                     });
//                 }
//             }
//             ga = "";
//         }
//         ga = "";
//     });
// }






//////////////////////// AGREGAR BARRA DESPLAZADORA A TABLA //////////////////////7
// Change the selector if needed
var $table = $('table.tabla_vistaPrevia'),
    $bodyCells = $table.find('tbody tr:first').children(),
    colWidth;

// Adjust the width of thead cells when window resizes
$(window).resize(function () {
    // Get the tbody columns width array
    colWidth = $bodyCells.map(function () {
        return $(this).width();
    }).get();

    // Set the width of thead columns
    $table.find('thead tr').children().each(function (i, v) {
        $(v).width(colWidth[i]);
    });
}).resize(); // Trigger resize handler