/**
 * Created by Damian on 17/11/2016.
 */
function objetoAjax() {
    var xmlhttp = false;
    try{
        xmlhttp = new ActiveXObject("Msxm12.XMLHTTP")
    }catch (e){
        try{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }catch (E){
            xmlhttp = false;
        }
    }

    if(!xmlhttp && typeof XMLHttpRequest != 'undefined'){
        xmlhttp = new XMLHttpRequest();
    }

    return xmlhttp;
}
function eliminar_vehiculo(dominio,marca,modelo,titular) {
    var resultado = document.getElementById('datosVehiculo');
    ajax = objetoAjax();
    ajax.open("GET","/datosVehiculo.php?dominio="+dominio+"&marca="+marca+"&modelo="+modelo+"&titular="+titular,true);
    ajax.onreadystatechange = function () {
        if(ajax.readyState == 4){
            resultado.innerHTML = ajax.responseText;


        }
    }
    ajax.send(null);
}
