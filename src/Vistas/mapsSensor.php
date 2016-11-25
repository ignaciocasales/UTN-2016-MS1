<?php include('navbar.php'); ?>
<div class="container lower-box box-primary">
    <div class="container">


        <table class="table">

            <thead>
            <tr>
                <th>Fecha Instalación</th>
                <th>Latitud | Longitud</th>
                <th>Número de Serie</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?= $obtener['fechaalta'] ?></td>
                <td><?php echo $obtener['latitud'] . ' | ' . $obtener['longitud'] ?></td>
                <td><?= $obtener['numeroserie'] ?></td>
            </tr>
            </tbody>
        </table>


        <a class="btn btn-primary" href="<?php if ($obtener['descripcion'] === 'multa') {
            echo '/consulta/sensoresMulta/';
        } else {
            echo '/consulta/sensoresPeaje/';
        } ?>" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Volver</a>

        <input class="btn btn-primary" type="button"
               onclick="init(<?= $obtener['longitud'] ?>,<?= $obtener['latitud'] ?>)" value="Mostrar mapa">


        <div id="map" style="width: 1137px; height: 373px; margin-top: 5px;"></div>

        <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDcvicJ0hoFQ8iVcqI1_qyC32bsHPML98I" async=""
                defer="defer" type="text/javascript"></script>

        <script type="text/javascript">
            var map;
            var marker;

            function init(longitud, latitud) {
                var mapOptions = {
                    center: new google.maps.LatLng(latitud, longitud),
                    zoom: 17,
                    zoomControl: false,
                    scaleControl: false,
                    mapTypeControl: false,
                    scrollwheel: false,
                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                    }

                }
                map = new google.maps.Map(document.getElementById("map"), mapOptions);

                var place = new google.maps.LatLng(latitud, longitud);
                marker = new google.maps.Marker({
                    position: place,
                    map: map
                });
            }
        </script>
    </div>
</div>


