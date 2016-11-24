<?php include('navbar.php'); ?>
<div class="container lower-box box-primary">
    <div clas ="container" >


        <input type="button" onclick="init()" value="Mostrar mapa">
        <div id="map" style="width: 1137px; height: 380px;"></div>

        <script src="http://maps.google.com/maps/api/js?sensor=false"> </script>

        <script type="text/javascript">
            var map;
            var marker;

            function init() {
                var mapOptions = {
                    center: new google.maps.LatLng(-38.0526,-57.5614),
                    zoom: 17,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                map = new google.maps.Map(document.getElementById("map"),mapOptions);

                var place = new google.maps.LatLng(-38.0526,-57.5614);
                marker = new google.maps.Marker({
                    position: place,
                    title: "sdasdasd",
                    map: map
                });
            }
        </script>

    </div>
</div>

