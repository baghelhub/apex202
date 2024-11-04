<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Store Locator</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places"></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>

    <input type="text" id="pincodeInput" placeholder="Enter Pin Code">
    <button onclick="searchMedicalStores()">Search</button>

    <div id="map"></div>

    <script>
        var mainLocationMarker;
        var hospitalMarkers = [];
        var shoppingMallMarkers = [];
        var infowindow;

        function searchMedicalStores() {
            var pincode = document.getElementById('pincodeInput').value;

            var geocoder = new google.maps.Geocoder();

            geocoder.geocode({ 'address': pincode }, function (results, status) {
                if (status == 'OK') {

                    var location = results[0].geometry.location;

                    var map = new google.maps.Map(document.getElementById('map'), {
                        center: location,
                        zoom: 14
                    });

                    // Add a marker for the main location (entered pin code)
                    mainLocationMarker = new google.maps.Marker({
                        map: map,
                        position: location,
                        title: 'Main Location',
                        icon: 'https://boarding.fursurefamily.com/wp-content/uploads/2023/11/main-marker-text.png', // Change the icon URL as needed
                    });

                    mainLocationMarker.addListener('mouseover', function () {
                        var starIcon = '★';
                        var contentString = '<div><strong>Baghel Place:</strong> ' + starIcon + ' 4.3<br>' +
                            'Name: ' + 'Amit Baghel' + '<br>' +
                            'Distance: ' + '0 km' + '<br>' +
                            '<a href="#" onclick="viewMainLocation()">View Location</a></div>';

                        infowindow = infowindow || new google.maps.InfoWindow();
                        infowindow.setContent(contentString);
                        infowindow.open(map, mainLocationMarker);

                        google.maps.event.addListenerOnce(infowindow, 'domready', function () {
                            var closeBtn = document.querySelector('.gm-style-iw button');
                            if (closeBtn) {
                                closeBtn.parentNode.removeChild(closeBtn);
                            }
                        });
                    });

                    mainLocationMarker.addListener('mouseout', function () {
                        if (infowindow) {
                            infowindow.close();
                        }
                    });

                    // Search for nearby hospitals
                    searchNearbyPlaces(map, location, 'hospital', hospitalMarkers);

                    // Search for nearby shopping malls
                    searchNearbyPlaces(map, location, 'shopping_mall', shoppingMallMarkers);

                } else {
                    console.error('Error in geocode:', status);
                }
            });
        }

        function searchNearbyPlaces(map, location, type, markersArray) {
            var request = {
                location: location,
                radius: 5000,
                types: [type]
            };

            var service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request, function (results, status) {
                if (status == 'OK') {

                    for (var i = 0; i < results.length; i++) {
                        var place = results[i];
                        console.log(place.name, place.vicinity);

                        // Add a marker for each place
                        var marker = new google.maps.Marker({
                            map: map,
                            position: place.geometry.location,
                            title: place.name,
                            icon: 'https://boarding.fursurefamily.com/wp-content/uploads/2023/11/marker-hover-1.png', // Change the icon URL as needed
                            label: type.charAt(0).toUpperCase(), // Use the first letter of the type as a label
                        });

                        markersArray.push(marker);
                        hideMarker(marker);
                    }

                } else {
                    console.error('Error in nearbySearch:', status);
                }
            });
        }

        function hideMarker(marker) {
            marker.setMap(null);
        }

        function showMarker(marker) {
            marker.setMap(map);
        }
    </script>

</body>
</html>
