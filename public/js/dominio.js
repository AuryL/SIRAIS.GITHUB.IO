var validarDom = function () {

    var escribirNombreEs = document.getElementById("dom_nombre_es");
    var escribirNombreEn = document.getElementById("dom_nombre_en");
    var escribirDetallesEs = document.getElementById("dom_detalles_es");
    var escribirDetallesEn = document.getElementById("dom_detalles_en");

    console.log(escribirNombreEs.innerHTML);
    console.log(escribirNombreEn.innerHTML);
    console.log(escribirDetallesEs.innerHTML);
    console.log(escribirDetallesEn.innerHTML);

    if (escribirNombreEs.innerHTML == "" || escribirNombreEn.innerHTML == "" || escribirDetallesEs.innerHTML == "" || escribirDetallesEn.innerHTML == "") {
        alert("Debes llenar todos los campos");
        return false
    } else {
        alert("Perfecto");
    }
}