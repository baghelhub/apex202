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
                    var mainLocationMarker = new google.maps.Marker({
                        map: map,
                        position: location,
                        title: 'Main Location',
                        icon: 'https://boarding.fursurefamily.com/wp-content/uploads/2023/11/main-marker-text.png' ,// Change the icon URL as needed
                      
                     });

                   var infowindow;
                    mainLocationMarker.addListener('mouseover', function () {
                    var starIcon = '★'; // Adjust the image path and styling
                    var contentString = '<div><strong>Baghel Place:</strong> ' + starIcon + ' 4.3<br>' +
                        'Name: ' + 'Amit Baghel' + '<br>' +
                        'Distance: ' + '0 km' + '<br>' +
                        '<a href="#" onclick="viewMainLocation()">View Location</a></div>';

                    // Create an instance of google.maps.InfoWindow only if it doesn't exist
                    infowindow = infowindow || new google.maps.InfoWindow();

                    // Set the content of the info window
                    infowindow.setContent(contentString);

                    // Open the info window at the position of the mainLocationMarker on the map
                    infowindow.open(map, mainLocationMarker);

                    // Remove the close button from the info window
                    google.maps.event.addListenerOnce(infowindow, 'domready', function () {
                        var closeBtn = document.querySelector('.gm-style-iw button');
                        if (closeBtn) {
                            closeBtn.parentNode.removeChild(closeBtn);
                        }
                    });
                });

                mainLocationMarker.addListener('mouseout', function () {
                    // Check if infowindow is defined before attempting to close it
                    if (infowindow) {
                        infowindow.close();
                    }
                });



            
                        // // Declare the infowindow variable outside of any functions or event listeners
                        // var infowindow;

                        // // Assuming mainLocationMarker and map are defined elsewhere in your code

                        // mainLocationMarker.addListener('mouseover', function () {
                        //     var starIcon = '★'; // Adjust the image path and styling
                        //     var contentString = '<div><strong>Baghel Place:</strong> ' + starIcon + ' 4.3<br>' +
                        //         'Name: ' + 'Amit Baghel' + '<br>' +
                        //         'Distance: ' + '0 km' + '<br>' +
                        //         '<a href="#" onclick="viewMainLocation()">View Location</a></div>';



                        //         // Create a custom info window using the InfoBox library
                        //     var infobox = new InfoBox({
                        //         content: contentString,
                        //         disableAutoPan: true,
                        //         pixelOffset: new google.maps.Size(-140, 0), // Adjust the offset as needed
                        //         closeBoxURL: "", // Set an empty string to remove the close button
                        //         isHidden: false,
                        //         enableEventPropagation: true,
                        //     });

                        //     // Create an instance of google.maps.InfoWindow only if it doesn't exist
                        //     infowindow = infowindow || new google.maps.InfoWindow({
                        //         content: contentString,
                        //          // Disable automatic panning to ensure the close button is not visible
                        //     });

                        //     // Open the info window at the position of the mainLocationMarker on the map
                        //     infowindow.open(map, mainLocationMarker);
                        // });

                        // mainLocationMarker.addListener('mouseout', function () {
                        //     // Check if infowindow is defined before attempting to close it
                        //     if (infowindow) {
                        //         infowindow.close();
                        //     }
                        // });
                                                        
                        // function generateStarRating(rating) {
                        //         var stars = '<div>';
                        //         for (var i = 1; i <= 5; i++) {
                        //             if (i <= rating) {
                        //                 stars += '★'; // Solid star for filled rating
                        //             } else {
                        //                 stars += '☆'; // Empty star for unfilled rating
                        //             }
                        //         }
                        //         stars += '</div>';
                        //         return stars;
                        //     }

                 /* end main marker hover  */ 

                    var request = {
                        location: location,
                        radius: 5000,
                        types: ['pet store']
                    };

                    var service = new google.maps.places.PlacesService(map);
                    service.nearbySearch(request, function (results, status) {
                        if (status == 'OK') {
                            
                            for (var i = 0; i < results.length; i++) {
                                var place = results[i];
                                console.log(place.name, place.vicinity);

                                // Add a marker for each medical store
                                var medicalStoreMarker = new google.maps.Marker({
                                    map: map,
                                    position: place.geometry.location,
                                    title: place.name,
                                    icon: 'https://boarding.fursurefamily.com/wp-content/uploads/2023/11/marker-hover-1.png', // Change the icon URL as needed
                                    label : 'A'
                                });
                            }
                            
                        } else {
                            console.error('Error in nearbySearch:', status);
                        }
                    });
                    
                } else {
                    console.error('Error in geocode:', status);
                }
            });
        }
    </script>

</body>
</html>
