<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://maps.googleapis.com/maps/api/place/textsearch/json?query=hospital%2Bin%2B201308&key=',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

$data  = json_decode($response,true);


 
foreach($data as $val){

    foreach($val as $innerval){
        // echo "<pre>";
        // echo $innerval['formatted_address'];
        foreach($innerval  as  $nextval) {
        
             echo "<pre>";
             print_r($nextval);
            
        }    
    }
}
die;
curl_close($curl);
echo $response;
