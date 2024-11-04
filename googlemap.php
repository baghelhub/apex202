<!DOCTYPE html>
<html>
<head>
  <title>Google Maps Location Selector</title>
  <script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places"></script>
</head>
<body>
  <div>
    <label for="pincode">Enter PIN code:</label>
    <input type="text" id="pincode">
    <button onclick="searchLocation()">Search</button>
  </div>
  <div id="map" style="height: 400px; width: 100%;"></div>
  <script>

    let map;
    let geocoder;

    function initMap() {
      //28.214243993098158, 77.55336940696559
         const centerOfIndia = { lat: 28.214243993098158, lng: 77.55336940696559 };
          map = new google.maps.Map(document.getElementById('map'), {
          center: centerOfIndia, // Default center, will be updated later
          zoom: 12, // Initial zoom level
      });

        geocoder = new google.maps.Geocoder();
   
    }

      function searchLocation() {
      const pincode = document.getElementById('pincode').value;
      geocoder.geocode({ 'address': pincode }, (results, status) => {
        if (status === 'OK' && results.length > 0) {
            const location = results[0].geometry.location;
            map.setCenter(location);
            new google.maps.Marker({
            map: map,
            position: location,
            title: 'Selected Location'
         
             });
        
            } else {
          alert('Location not found');
        }
      });
    }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=&libraries=places&callback=initMap"></script>
</body>
</html>
