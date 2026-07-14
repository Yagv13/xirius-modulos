<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);

require_once 'db.php';

header('Content-Type: application/json; charset=utf-8');

function obtenerModulos() {
    global $conn;
    $query = "SELECT * FROM modulos ORDER BY fecha_creacion ASC";
    $result = $conn->query($query);
    $modulos = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $modulos[] = $row;
        }
    }
    return $modulos;
}

function obtenerModulo($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM modulos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function crearModulo($nombre, $descripcion) {
    global $conn;
    $stmtCheck = $conn->prepare("SELECT id FROM modulos WHERE nombre = ?");
    $stmtCheck->bind_param("s", $nombre);
    $stmtCheck->execute();
    if ($stmtCheck->get_result()->num_rows > 0) {
        return "duplicado";
    }

    $stmt = $conn->prepare("INSERT INTO modulos (nombre, descripcion, fecha_creacion) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $nombre, $descripcion);
    return $stmt->execute();
}

function editarModulo($id, $nombre, $descripcion) {
    global $conn;
    $stmt = $conn->prepare("UPDATE modulos SET nombre = ?, descripcion = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nombre, $descripcion, $id);
    return $stmt->execute();
}

function eliminarModulo($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM modulos WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}


$accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : '';

try {
    switch ($accion) {
        case 'listar':
            $data = obtenerModulos();
            echo json_encode(['success' => true, 'data' => $data]);
            break;

        case 'guardar':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
                $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
                $id = (isset($_POST['id']) && !empty($_POST['id'])) ? intval($_POST['id']) : null;

                if (empty($nombre) || empty($descripcion)) {
                    echo json_encode(['success' => false, 'message' => 'El nombre y la descripción son obligatorios.']);
                    exit();
                }

                if ($id === null) {
                    $res = crearModulo($nombre, $descripcion);
                    if ($res === "duplicado") {
                        echo json_encode(['success' => false, 'message' => 'Ya existe un módulo con ese mismo nombre.']);
                    } elseif ($res) {
                        echo json_encode(['success' => true, 'message' => 'Módulo creado correctamente.']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error al guardar el módulo en la base de datos.']);
                    }
                } else {
                    if (editarModulo($id, $nombre, $descripcion)) {
                        echo json_encode(['success' => true, 'message' => 'Módulo actualizado correctamente.']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error al actualizar el módulo.']);
                    }
                }
            }
            break;

        case 'eliminar':
            $id = isset($_POST['id']) ? intval($_POST['id']) : (isset($_GET['id']) ? intval($_GET['id']) : null);
            if ($id && eliminarModulo($id)) {
                echo json_encode(['success' => true, 'message' => 'Módulo eliminado del sistema.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se pudo eliminar el módulo seleccionado.']);
            }
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Acción no válida o no definida.']);
            break;
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error del servidor: ' . $e->getMessage()]);
}
exit();
?>