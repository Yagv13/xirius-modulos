<?php
require_once 'db.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt=$conn->prepare("DELETE FROM modulos WHERE id=?");
    $stmt->bind_param("i",$id);

    if ($stmt->execute()){
        header("Location: modulos.php");
        exit();
    }else{
        echo "Error al eliminar el registro: " . $conn->error;
    }
}else{
    header("Location: modulos.php");
    exit();
}
?>