<!DOCTYPE html>
<html>
<head>
  <title>Find All Locations</title>
  <style>

    /*--------- css for map viewing */
    #map {
      height: 400px;
      width: 100%;
    }

    /*---------------- css for marker indexing value*/
    .marker-label {
      background-color: #0074D9;
      color: #FFF;
      border-radius: 50%;
      padding: 4px;
      font-size: 14px;
      text-align: center;
      width: 30px;
      height: 30px;
      line-height: 30px;
    }
  </style>  
  </head>
 <body>
  <h1>Google Map Markers</h1>
  <div id="map"></div>
  <script>

    /* ------------------------ for country latLang */
    function initMap() {
      const map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 22.84140440415612, lng: 79.39871001693325 }, // Center of the map India
        zoom: 5, // Initial zoom level
      });

      /* --------------------------------------------- Array of marker locations */
      //28.708019888292768, 76.91552208728608
      const markerLocations = [
        { lat: 28.538692086082808, lng: 77.38978699435054, title: 'Noida' },
        { lat: 28.69561964587397, lng: 77.21217604299412, title: 'Delhi' },
        { lat: 28.45999023971286, lng: 77.02440251984056, title: 'Gurgaon' },
        { lat: 28.410877465263187, lng: 77.84939809676044, title: 'bulandshahar' },
        { lat: 28.708019888292768, lng: 76.91552208728608, title: 'mp' },
        // Add more markers as needed
      ];

      /* --------------------------------------------- google marker locator */
        const bounds = new google.maps.LatLngBounds();
        markerLocations.forEach((location, index) => {
        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(location.lat, location.lng),
            map: map,
            label: {
              text: (index + 1).toString(),
              className: 'marker-label',
          },
        });

        /*--------------------------------- Extend the bounds to include this marker's position */
          bounds.extend(marker.getPosition());


        /* --------------------------------- Add an event listener for clicking on the marker */
        marker.addListener('click', function() {
         
        /* ---------------------------------- Handle marker click, e.g., display an info window*/
          const infoWindow = new google.maps.InfoWindow({
            content: location.title,
          });
          infoWindow.open(map, marker);
        });
      });

    /* --------------------- Fit the map to the calculated bounds*/
      map.fitBounds(bounds);
    }
     
      </script>
      <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2L_BzdbcjKVOE8uxdEIpnscDlIPEfq-0&callback=initMap">
     </script>
</body>
</html>
