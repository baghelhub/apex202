<!DOCTYPE html>
<html>
<head>
  <title>Map Image Converter</title>
  <style>
  </style>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkrbOWIMyWiWkPnJbQ-9_kRUlY73X4Ky8&libraries=places"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <div class="col-md-6">
    <h5>Map</h5>
    <input id="locationInput" type="text" placeholder="Enter a location">
    <div id="map" style="width: 100%; height: 500px;"></div>
  </div>

  <script>
    var map;
    var marker;
    var directionsService;
    var directionsRenderer;
    var shopMarker; // Reference to the shop marker

    function initMap() {
      const input = document.getElementById('locationInput');
      const mapElement = document.getElementById('map');

      const mapOptions = {
        zoom: 12,
        center: {
          
          lat: 28.254258381782297,
          lng: 77.59404728878954
        },
        disableDefaultUI: true, // Hide default UI elements, including the location marker
        styles: [
  {
    featureType: 'all',
    elementType: 'geometry',
    stylers: [
      {
        color: '#f4f4f4' // Set the background color here
      }
    ]
  },
  {
    featureType: 'all',
    elementType: 'labels.text.fill',
    stylers: [
      {
        color: '#a29e9e' // Set the text color to dark gray
      }
    ]
  },
  {
    featureType: 'road',
    elementType: 'geometry.fill',
    stylers: [
      {
        color: '#FFFFFF' // Set the road color here
      }
    ]
  },
  {
    featureType: 'water',
    elementType: 'geometry.fill',
    stylers: [
      {
        color: '#a6cbe5' // Set the color for water features (rivers, lakes, etc.)
      }
    ]
  },
  {
    featureType: 'transit',
    elementType: 'geometry.fill',
    stylers: [
      {
        color: '#c2c2c2' // Set the color for transit features (paths, walking routes, etc.)
      }
    ]
  }
]

      };

      map = new google.maps.Map(mapElement, mapOptions);
      directionsService = new google.maps.DirectionsService();
      directionsRenderer = new google.maps.DirectionsRenderer({
        map: map,
        polylineOptions: {
          strokeColor: '#ffffff',
          strokeWeight: 8
        },
        suppressMarkers: true  // Hide default markers for directions
      });

      const autocomplete = new google.maps.places.Autocomplete(input);

      autocomplete.addListener('place_changed', function () {
        const place = autocomplete.getPlace();
        if (!place.geometry) {
          alert('Location not found');
          return;
        }
        clearMarkers();
        directionsRenderer.setDirections({
          routes: []
        });

        calculateAndDisplayRoute(place.geometry.location);
      });

      // Request user's location
      navigator.geolocation.getCurrentPosition(
        position => {
          const userLocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          // Your existing code to use the user's location goes here
        },
        error => {
          console.error(error.message);
        },
        {
          enableHighAccuracy: false,
          timeout: 5000,
          maximumAge: 0
        }
      );

      // Create a custom shop marker
      shopMarker = new google.maps.Marker({
        position: { lat: YOUR_SHOP_LATITUDE, lng: YOUR_SHOP_LONGITUDE },
        map: map,
        // Other marker options...
      });
    }

    function calculateAndDisplayRoute(destination) {
      directionsService.route({
        origin: map.getCenter(),
        destination: destination,
        travelMode: 'DRIVING'
      }, function (response, status) {
        if (status === 'OK') {
          directionsRenderer.setDirections(response);
        } else {
          window.alert('Directions request failed due to ' + status);
        }
      });
    }

    function clearMarkers() {
      if (marker) {
        marker.setMap(null);
      }
      if (shopMarker) {
        shopMarker.setMap(null); // Hide the shop marker
      }
    }

    window.addEventListener('load', initMap);
  </script>
</body>
</html>
