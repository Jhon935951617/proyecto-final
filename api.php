<?php
// Datos
$apikey = 'fdf12d25457643d69d705f48b8a435f6';

// Iniciar llamada a API
$curl = curl_init();

// Buscar dni
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.spoonacular.com/recipes/random?number=1&apiKey=' . $apikey,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 2,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(),
));

$response = curl_exec($curl);
echo $response;


// curl_close($curl);
// // Datos listos para usar
// $persona = json_decode($response);
// var_dump($persona);
?>