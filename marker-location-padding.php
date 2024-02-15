<!DOCTYPE html>
<html>
<head>
  <title>Location Finder</title>
  <style>
  </style>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2L_BzdbcjKVOE8uxdEIpnscDlIPEfq-0&libraries=places"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-6">
    <h5>Map</h5>
    <input type="text" class="form-control" id="locationInput" placeholder="Enter a location">
    <div id="map" style="width: 100%; height: 400px;"></div>
    </div>
    <div class="col-md-6">
    <h5>Location image</h5>
  <img id="staticMap" alt="Static Map" style="width: 400px; height: 400px; display: none;">
</div>
  </div>
</div>

  <script>
    var map;
    var marker;
    var customBounds;
    var padding = 0.002; // Adjust the padding as needed

    function initMap() {
      const input = document.getElementById('locationInput');
      const mapElement = document.getElementById('map');
      customBounds = new google.maps.LatLngBounds(); // Custom LatLngBounds

      const mapOptions = {
        zoom: 10,
        center: { lat: 23.195128833176202, lng: 78.14472729233671 } // Default center
      };
      map = new google.maps.Map(mapElement, mapOptions);

      const autocomplete = new google.maps.places.Autocomplete(input);

      autocomplete.addListener('place_changed', function() {
        const place = autocomplete.getPlace();
        if (!place.geometry) {
          alert('Location not found');
          return;
        }

        // Clear previous marker, if any
        if (marker) {
          marker.setMap(null);
        }

        // Add a new marker at the selected location
        marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location,
          // title: place.name
        });

        // Extend the custom LatLngBounds with the marker's position
        customBounds.extend(place.geometry.location);

        // Adjust the bounds with padding
        customBounds.extend({
          lat: customBounds.getNorthEast().lat() + padding,
          lng: customBounds.getNorthEast().lng() + padding
        });
        customBounds.extend({
          lat: customBounds.getSouthWest().lat() - padding,
          lng: customBounds.getSouthWest().lng() - padding
        });

        // Fit the map to the custom LatLngBounds
        map.fitBounds(customBounds);

        // Generate a static map immediately with adjusted zoom level for padding
        generateStaticMap(customBounds);
      });
    }

    function generateStaticMap(bounds) {
      // Get the center of the LatLngBounds
      const center = bounds.getCenter();

      // Calculate the zoom level based on the bounds and padding
      const paddingZoom = 19; // Adjust the zoom level as needed

      // Generate a static map URL with the bounds center and adjusted zoom level
      const staticMapUrl = `https://maps.googleapis.com/maps/api/staticmap?center=${center.lat()},${center.lng()}&zoom=${paddingZoom}&size=400x400&markers=color:blue%7Clabel:A%7C${center.lat()},${center.lng()}&style=feature:poi|visibility:off&key=AIzaSyD2L_BzdbcjKVOE8uxdEIpnscDlIPEfq-0`;

      // Set the src attribute of the img tag to display the static map image
      const staticMapImg = document.getElementById('staticMap');
      staticMapImg.src = staticMapUrl;
      staticMapImg.style.display = 'block';
    }

    window.addEventListener('load', initMap);
  </script>
</body>
</html>
