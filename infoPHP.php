<?php
// Establecemos el encabezado para que la respuesta sea de tipo

header('Content-Type: application/json');
// Obtenemos el método de la solicitud
$requestMethod = $_SERVER['REQUEST_METHOD'];
// Obtenemos la URL de la solicitud
$requestUri = $_SERVER['REQUEST_URI'];
// Creamos un arreglo para almacenar la información de los

$headers = getallheaders();
// Agregamos la información a un arreglo de respuesta
$response = [
    'request_method' => $requestMethod,
    'request_uri' => $requestUri,
    'headers' => $headers,
];
// Agregamos información adicional
$response['client_ip'] = $_SERVER['REMOTE_ADDR'];
$response['server_software'] = $_SERVER['SERVER_SOFTWARE'];
$response['protocol'] = $_SERVER['SERVER_PROTOCOL']; // Enviamos la respuesta como JSON
echo json_encode($response, JSON_PRETTY_PRINT);
