<?php
$devON = true;// Cambia a true para desarrollo local, false para producción
if ($devON == false) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "xirius_modulos";
} else {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "xirius_modulos";
}

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>