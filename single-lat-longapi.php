<!DOCTYPE html>
<html>
<head>
  <title>Google Map with Marker</title>
  <style>
    #map {
      height: 400px;
      width: 100%;
    }
  </style>
</head>
<body>
  <h1>Google Map with Marker</h1>
  <div id="map"></div>

  <script>
    function initMap() {
        //28.524231457171272, 77.49486571857682
      // Define the coordinates (latitude and longitude)
      const myLatLng = { lat: 28.52434123103905, lng: 77.49224198475632 }; // Example coordinates for New York City

      // Create a new map centered at the specified coordinates
      const map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 14, // Adjust the zoom level as needed
      });

      // Create a marker and set its position
      const marker = new google.maps.Marker({
        map: map,
        position: myLatLng,
        title: 'Marker Title', // Replace with your desired title
      });
    }
  </script>

  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap">
  </script>
</body>
</html>
