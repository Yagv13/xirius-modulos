<?php
$devON = true;// Cambia a true para desarrollo local, false para producción
if ($devON == false) {
    $servername = "";
    $username = "";
    $password = "";
    $database = "";
} else {
    $servername = "";
    $username = "";
    $password = "";
    $database = "";
}

$conn = new mysqli($servername, $username, $password, $database);
