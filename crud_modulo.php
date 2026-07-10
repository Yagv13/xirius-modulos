<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once 'db.php';

function obtenerModulos (){
    global $conn;
    $query="SELECT*FROM modulos ORDER BY fecha_creacion ASC";
    return $conn->query($query);
}

function obtenerModulo ($id){
    global $conn;
    $stmt=$conn->prepare("SELECT*FROM modulos WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();

}

function crearModulo($nombre,$descripcion){
    global $conn;
    $stmtCheck=$conn->prepare("SELECT id FROM modulos WHERE nombre=?");
    $stmtCheck->bind_param("s",$nombre);
    $stmtCheck->execute();
    if ($stmtCheck->get_result()->num_rows>0){
        return "duplicado";
    }
    $stmt=$conn->prepare("INSERT INTO modulos (nombre, descripcion, fecha_creacion) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss",$nombre, $descripcion);
    return $stmt->execute();
}

function editarModulo($id, $nombre, $descripcion) {
    global $conn;
    $stmt=$conn->prepare("UPDATE modulos SET nombre = ?, descripcion = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nombre, $descripcion, $id);
    return $stmt->execute();
}

function eliminarModulo($id){
    global $conn;
    $stmt=$conn->prepare("DELETE FROM modulos WHERE id=?");
    $stmt->bind_param("i",$id);
    return $stmt->execute();
}

$accion=isset($_REQUEST['accion']) ? $_REQUEST['accion'] : '';

switch ($accion){
    case 'guardar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nombre=trim($_POST['nombre']);
            $descripcion=trim($_POST['descripcion']);
            $id=(isset($_POST['id']) && !empty($_POST['id'])) ? intval($_POST['id']) : null;

            if (empty($nombre) || empty($descripcion)){
                die("Error: El nombre y la descripción son obligatorios.");
            }

            if ($id === null){
                $resultado=crearModulo($nombre, $descripcion);
                if ($resultado === "duplicado"){
                    header ("Location: modulos.php?error=duplicado");
                } elseif ($resultado){
                    header("Location: modulos.php?success=1");
                }else{
                    die("Error al crear el módulo.");
                }
            }else{
                if (editarModulo($id, $nombre, $descripcion)){
                    header("Location: modulos.php?updated=1");
                }else{
                    die("Error al actualizar el módulo.");
                }
            }    
            exit();
        }
        break;

    case 'eliminar':
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
        if ($id && eliminarModulo($id)){
            header("Location: modulos.php?deleted=1");
        }else{
            die("Error al eliminar módulo.");
        }
        exit();
        break;

    default:
        break;
}
?>
