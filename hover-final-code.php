<!DOCTYPE html>
 <html>
 <head>


 <!-- India latlang :  23.195128833176202, 78.14472729233671 -->
  <!----------------------------- Title and bootstrap and external css File -->
      <title>marker api</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="styles.css" />
 </head>
 <body>
  <div class="container-fluid">
     <h4>Google Map Markers</h4>
     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s.</p>
   <div class="row">
   
   <!--------------------- pet store List  -->

       <div class="col-sm-6">
          <ul class="list-group hover-list"> 
            <li class="list-group-item cls1" id="cusone-0">One</li>
            <li class="list-group-item"      id="cusone-1">Two</li>
            <li class="list-group-item"      id="cusone-2">Three</li>
            <li class="list-group-item"      id="cusone-3">Four</li>
            <li class="list-group-item"      id="cusone-4">Five</li>
         <!-- Add more list items as needed -->
        </ul>
      </div>
  
  <!-------------------------- google map div -->
       <div class="col-sm-6">
           <div id="map"></div>
       </div>
     </div>
    <br>
  </div>

<script>

/* ------------------------ country latLang and zoom code */
    
   function initMap() {
      const map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 22.84140440415612, lng: 79.39871001693325 }, // Center of the map India
        zoom: 5,
        styles: [
      {
        featureType: 'all',
        elementType: 'all',
        stylers: [
          { saturation: -40 }, // You can adjust saturation as needed
          { lightness: 50 }, // Adjust lightness as needed
        ],
      },
    ],

      });

/* ---------------------------------------------------------- Array of marker locations latitute and lontitute */
     
    
    const markerLocations = [
       
            { lat: 28.538692086082808, lng: 77.38978699435054, title: 'Noida' },
            { lat: 28.69561964587397, lng: 77.21217604299412, title: 'Delhi' },
            { lat: 28.45999023971286, lng: 77.02440251984056, title: 'Gurgaon' },
            { lat: 28.410877465263187, lng: 77.84939809676044, title: 'bulandshahar' },
            { lat: 28.708019888292768, lng: 76.91552208728608, title: 'mp' },
        
        ];

/* ----------------------------------------------------------- Google map marker locator */
       
      /*---- Create a custom marker icon ----*/
      const customMarkerIcon = {
          url: 'http://localhost/apex/wp-content/uploads/2024/01/grey-one.png', // 
          scaledSize: new google.maps.Size(35, 35), 
      };



        const bounds = new google.maps.LatLngBounds();
        markerLocations.forEach((location, index) => {
       
          const marker = new google.maps.Marker({
              position: new google.maps.LatLng(location.lat, location.lng),
              map: map,
              icon: customMarkerIcon,
              label: {
              text: 'Y P',
           /* text: (index + 1).toString(), */
              className: 'marker-label',
              color :'Black',
            },
        });



/*-------------------------- Mouse Hover  From List to map marker  ------------------------------*/
       
        const ulElements = document.querySelectorAll('#cusone-'+index);
        ulElements.forEach(function (li) {
            li.addEventListener('mouseover', function (event) {
                      var cusoneElement = document.getElementById('cusone-'+index);
                      cusoneElement.style.backgroundColor = 'skyblue';

                      marker.setLabel({
                          text: 'RJ',
                          className: 'marker-label marker-hover',
                          color :'yellow',
                  });
                  customMarkerIcon.url = 'http://localhost/apex/wp-content/uploads/2024/01/yellow-two.png'; // Replace with the URL of the hover marker image
                  marker.setIcon(customMarkerIcon);
            });

            li.addEventListener('mouseout', function (event) {
                      var cusoneElement = document.getElementById('cusone-'+index);
                      cusoneElement.style.backgroundColor = '';

                      marker.setLabel({
                        text: (index + 1).toString(),
                        className: 'marker-label',
                        color :'white',
                      });
                      customMarkerIcon.url = 'http://localhost/apex/wp-content/uploads/2024/01/grey-one.png'; // Replace with the URL of the hover marker image
                      marker.setIcon(customMarkerIcon);
                  });
                
            });



/* ------------------------------------------------------------------  hover from marker to html div */ 
    
           marker.addListener('mouseover', function () {
                  var cusoneElement = document.getElementById('cusone-'+index);
                  cusoneElement.style.backgroundColor = 'skyblue';

                  marker.setLabel({
                      text: 'AB',
                      className: 'marker-label marker-hover',
                      color :'yellow',
                  });

                  customMarkerIcon.url = 'http://localhost/wptest/wp-content/uploads/2023/11/marker-yellow.png'; // Replace with the URL of the hover marker image
                  marker.setIcon(customMarkerIcon);
                });

            marker.addListener('mouseout', function () {
                    var cusoneElement = document.getElementById('cusone-'+index);
                    cusoneElement.style.backgroundColor = '';

                    marker.setLabel({
                    text: (index + 1).toString(),
                    className: 'marker-label',
                    color :'white',
                  });
                  customMarkerIcon.url = 'http://localhost/wptest/wp-content/uploads/2023/10/Location.png'; // Replace with the URL of the hover marker image
                  marker.setIcon(customMarkerIcon);

            });



/*--------------------------- marker click functionality --------------------------------*/

    marker.addListener('click', function () {
     //alert(`Marker Index: ${index}`);
        document.getElementById('cusone-'+index).textContent = `Marker Value: ${index}`;
      
      });


/*------------------------- Extend the bounds to include this marker's position ----------*/

          bounds.extend(marker.getPosition());


/* -------------------------------------------------------- Add an event listener for clicking on the marker */
        marker.addListener('click', function() {
         
/* -------------------------------------------------------- Handle marker click, e.g., display an info window*/
          const infoWindow = new google.maps.InfoWindow({
            content: location.title,
          });
          infoWindow.open(map, marker);
        });
      });

/*----------------------------------------------------------  remove the map and satelite button top left  */
      map.setOptions({
      mapTypeControl: false,
      mapTypeControlOptions: {
      mapTypeIds: []
       }
  });


/* --------------------------------------------------------   Fit the map to the calculated bounds*/
         map.fitBounds(bounds);
    }
        
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"></script>

