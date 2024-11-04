<!DOCTYPE html>
<html>
<head>
  <title>Find Pet Stores by ZIP Code</title>
  <style>
    #map {
      height: 400px;
      width: 100%;
    }
  </style>
</head>
<body>
  <h1>Find Pet Stores by ZIP Code</h1>
  <form>
    <label for="zipCode">Enter ZIP Code:</label>
    <input type="text" id="zipCode">
    <button type="button" onclick="findPetStoresByZIP()">Find Pet Stores</button>
  </form>
  <div id="map"></div>

  <script>
    let map;
    let geocoder;
    let markers = [];

    function initMap() {
      
      const centerOfIndia = { lat: 20.5937, lng: 78.9629 };
       map = new google.maps.Map(document.getElementById('map'), {
       center: centerOfIndia, // Default center, will be updated later
       zoom: 12, // Initial zoom level
   });

     geocoder = new google.maps.Geocoder();

 }

    function findPetStoresByZIP() {
      const zipCode = document.getElementById('zipCode').value;

      if (zipCode.trim() === '') {
        alert('Please enter a ZIP code.');
        return;
      }

      geocoder.geocode({ 'address': zipCode }, (results, status) => {
        if (status === 'OK' && results.length > 0) {
          const location = results[0].geometry.location;
          map.setCenter(location);

          // Create a request to search for pet stores
          const request = {
            location: location,
            radius: 1000, // Adjust the radius as needed (in meters)
            keyword: 'pet store',
          };
          const service = new google.maps.places.PlacesService(map);
          service.nearbySearch(request, (results, status) => {
            if (status === 'OK') {
               console.log(status);
              clearMarkers();
              for (let i = 0; i < results.length; i++) {
                createMarker(results[i]);
              }
            } else {
              alert('No pet stores found nearby.');
            }
          });
        } else {
          alert('Location not found for the entered ZIP code.');
        }
      });
    }

    function createMarker(place) {
      const marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location,
        title: place.name,
        icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png', // Red marker icon
      });
      markers.push(marker);
    }

    function clearMarkers() {
      for (let i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
      }
      markers.length = 0;
    }
  </script>

  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap">
  </script>
</body>
</html>
