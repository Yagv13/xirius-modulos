<?php
require_once 'db.php';

$query = "SELECT * FROM modulos ORDER BY fecha_creacion DESC";
$resultado = $conn->query($query);

if (!$resultado) {
    die("Error al consultar módulos: " . $conn->error);
}
?>