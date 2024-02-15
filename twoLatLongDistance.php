<!DOCTYPE html>
<html>
  <head>
    <title>Static Distance Calculation</title>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2L_BzdbcjKVOE8uxdEIpnscDlIPEfq-0&libraries=geometry"
      async
      defer
    ></script>
    <style>
      #map {
        height: 400px;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <div id="distanceInfo">
      <p>Distance from Noida to Delhi: <span id="noidaToDelhiDistance"></span> kilometers</p>
      <p>Distance from Delhi to Noida: <span id="delhiToNoidaDistance"></span> kilometers</p>
    </div>

    <script>
         //28.41898989028543, 77.30964888345102
      function initMap() {
        var noida = { lat: 28.6139, lng: 77.2090 };
        var delhi = { lat: 28.41898989028543, lng: 77.30964888345102 };

        var map = new google.maps.Map(document.getElementById("map"), {
          center: noida,
          zoom: 8
        });

        var distanceNoidaToDelhi = google.maps.geometry.spherical.computeDistanceBetween(
          new google.maps.LatLng(noida.lat, noida.lng),
          new google.maps.LatLng(delhi.lat, delhi.lng)
        );

        var distanceDelhiToNoida = google.maps.geometry.spherical.computeDistanceBetween(
          new google.maps.LatLng(delhi.lat, delhi.lng),
          new google.maps.LatLng(noida.lat, noida.lng)
        );

        // Convert meters to kilometers
        distanceNoidaToDelhi = distanceNoidaToDelhi / 1000;
        distanceDelhiToNoida = distanceDelhiToNoida / 1000;

        document.getElementById("noidaToDelhiDistance").textContent = distanceNoidaToDelhi.toFixed(2);
        document.getElementById("delhiToNoidaDistance").textContent = distanceDelhiToNoida.toFixed(2);

        var noidaMarker = new google.maps.Marker({ position: noida, map: map });
        var delhiMarker = new google.maps.Marker({ position: delhi, map: map });
      }
    </script>
    <script>
      // Replace 'YOUR_API_KEY' with your actual API key
      function loadScript() {
        var script = document.createElement("script");
        script.src =
          "https://maps.googleapis.com/maps/api/js?key=AIzaSyD2L_BzdbcjKVOE8uxdEIpnscDlIPEfq-0&libraries=geometry&callback=initMap";
        document.body.appendChild(script);
      }

      window.onload = loadScript;
    </script>
  </body>
</html>
