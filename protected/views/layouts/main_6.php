<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <style type="text/css">
            html { height: 100% }
            body { height: 100%; margin: 0; padding: 0 }
            #map { height: 100% }
        </style>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL2xkLRGH5KKCHULrY7PEzDhBEsBvkwjE"></script>
        <script>
            function initialize() {
                var mapStyles = [{featureType: 'water', elementType: 'all', stylers: [{hue: '#d7ebef'}, {saturation: -5}, {lightness: 54}, {visibility: 'on'}]}, {featureType: 'landscape', elementType: 'all', stylers: [{hue: '#eceae6'}, {saturation: -49}, {lightness: 22}, {visibility: 'on'}]}, {featureType: 'poi.park', elementType: 'all', stylers: [{hue: '#dddbd7'}, {saturation: -81}, {lightness: 34}, {visibility: 'on'}]}, {featureType: 'poi.medical', elementType: 'all', stylers: [{hue: '#dddbd7'}, {saturation: -80}, {lightness: -2}, {visibility: 'on'}]}, {featureType: 'poi.school', elementType: 'all', stylers: [{hue: '#c8c6c3'}, {saturation: -91}, {lightness: -7}, {visibility: 'on'}]}, {featureType: 'landscape.natural', elementType: 'all', stylers: [{hue: '#c8c6c3'}, {saturation: -71}, {lightness: -18}, {visibility: 'on'}]}, {featureType: 'road.highway', elementType: 'all', stylers: [{hue: '#dddbd7'}, {saturation: -92}, {lightness: 60}, {visibility: 'on'}]}, {featureType: 'poi', elementType: 'all', stylers: [{hue: '#dddbd7'}, {saturation: -81}, {lightness: 34}, {visibility: 'on'}]}, {featureType: 'road.arterial', elementType: 'all', stylers: [{hue: '#dddbd7'}, {saturation: -92}, {lightness: 37}, {visibility: 'on'}]}, {featureType: 'transit', elementType: 'geometry', stylers: [{hue: '#c8c6c3'}, {saturation: 4}, {lightness: 10}, {visibility: 'on'}]}];
                var mapOptions = {
                    center: new google.maps.LatLng(-23.0004939, -43.3984272),
                    zoom: 12,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    styles: mapStyles
                };
                var map = new google.maps.Map(document.getElementById("map"), mapOptions);
            }
        </script>
    </head>
    <body onload="initialize()">
        <!-- Map -->
        <div id="map"></div>
        <!-- end Map -->
    </body>
</html>	