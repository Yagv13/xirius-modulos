<?php

$host = "localhost";
$user = "root";
$password = ""; 
$database = "xirius_modulos"; // Tu base de datos

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die(json_encode([
        'success' => false, 
        'message' => 'Error crítico de conexión a la base de datos: ' . $conn->connect_error
    ]));
}

$conn->set_charset("utf8");

return $conn;