<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
    $id = (isset($_POST['id']) && !empty($_POST['id'])) ? intval($_POST['id']) : null;

    
    if (empty($nombre) || empty($descripcion)) {
        die("Error: El nombre y la descripción son campos obligatorios.");
    }

    if ($id === null) {
        
        $stmt = $conn->prepare("INSERT INTO modulos (nombre, descripcion, fecha_creacion) VALUES (?, ?, NOW())");
        
        if ($stmt === false) {
            die("Error al preparar la consulta de inserción: " . $conn->error);
        }
        
        $stmt->bind_param("ss", $nombre, $descripcion);
        
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: modulos.php");
            exit();
        } else {
            die("Error al insertar el registro en la base de datos: " . $stmt->error);
        }
        
    } else {
        
        $stmt = $conn->prepare("UPDATE modulos SET nombre = ?, descripcion = ? WHERE id = ?");
        
        if ($stmt === false) {
            die("Error al preparar la consulta de actualización: " . $conn->error);
        }
        
        $stmt->bind_param("ssi", $nombre, $descripcion, $id);
        
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: modulos.php");
            exit();
        } else {
            die("Error al actualizar el registro: " . $stmt->error);
        }
    }
} else {
    
    header("Location: modulos.php");
    exit();
}
?>