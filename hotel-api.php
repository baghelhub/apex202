<!DOCTYPE html>
<html>
<head>
  <title>Find Nearby Hotels</title>
  <script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places"></script>
</head>
<body>
  <div id="map" style="width: 100%; height: 400px;"></div>

  <script>
    function initialize() {
      // Create a map centered at a location (e.g., Delhi).
      const center = { lat: 22.84140440415612, lng: 79.39871001693325 };
      const map = new google.maps.Map(document.getElementById('map'), {
        center: center,
        zoom: 15
      });

      // Use the Geocoder to convert a location name to coordinates.
      const geocoder = new google.maps.Geocoder();
      geocoder.geocode({ address: 'Delhi' }, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
          const location = results[0].geometry.location;

          // Use the Places Service to find nearby hotels.
          const placesService = new google.maps.places.PlacesService(map);
          placesService.nearbySearch({
            location: location,
            radius: 1000, // 1000 meters radius
            type: 'restaurant'
          }, function(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
              for (let i = 0; i < results.length; i++) {
                const place = results[i];
                // Display markers for hotels.
                new google.maps.Marker({
                  position: place.geometry.location,
                  map: map,
                  title: place.name
                });
              }
            }
          });
        }
      });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
  </script>
</body>
</html>
