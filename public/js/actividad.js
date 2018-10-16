var validarAct = function () {

    var escribirNombreEs = document.getElementById("act_nombre_es");
    var escribirNombreEn = document.getElementById("act_nombre_en");
    var escribirDetallesEs = document.getElementById("act_detalles_es");
    var escribirDetallesEn = document.getElementById("act_detalles_en");


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
    } 
    // else {
    //     alert("Perfecto");
    // }
}
