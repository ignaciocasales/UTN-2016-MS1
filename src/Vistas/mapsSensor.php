<?php include('navbar.php'); ?>
<div class="container lower-box box-primary">
    <div clas ="container" >


        <input type="button" onclick="init(<?= $obtener['longitud'] ?>,<?= $obtener['latitud'] ?>)" value="Mostrar mapa">
        <div id="map" style="width: 1137px; height: 380px;"></div>

        <script src="http://maps.google.com/maps/api/js?sensor=false"> </script>
        <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDcvicJ0hoFQ8iVcqI1_qyC32bsHPML98I" async="" defer="defer" type="text/javascript"></script>

        <script type="text/javascript">
            var map;
            var marker;

            function init(longitud,latitud) {
                var mapOptions = {
                    center: new google.maps.LatLng(latitud,longitud),
                    zoom: 17,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                map = new google.maps.Map(document.getElementById("map"),mapOptions);

                var place = new google.maps.LatLng(latitud,longitud);
                marker = new google.maps.Marker({
                    position: place,
                    title: "sdasdasd",
                    map: map
                });
            }
        </script>

    </div>
</div>

