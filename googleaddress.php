<?php
// Replace 'YOUR_API_KEY' with your actual API key
$api_key = 'AIzaSyD2L_BzdbcjKVOE8uxdEIpnscDlIPEfq-0';

// Address to geocode
$address = '203209';

// URL to the Geocoding API
$url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address) . "&key=" . $api_key;

// Send the request to the API
$response = file_get_contents($url);

// Check if the request was successful
if ($response === false) {
    die('Error: Unable to connect to the Google Maps API.');
}

// Decode the JSON response
$data = json_decode($response);

echo "<pre>";
print_r($data);

// Extract the coordinates
if ($data->status === 'OK' && isset($data->results[0]->geometry->location)) {
    $latitude = $data->results[0]->geometry->location->lat;
    $longitude = $data->results[0]->geometry->location->lng;
    echo "Latitude: $latitude<br>";
    echo "Longitude: $longitude<br>";
} else {
    echo 'Geocoding failed. Status: ' . $data->status;
}
?>
