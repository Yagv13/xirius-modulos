<?php

ini_set('display_errors', 0);
error_reporting(E_ALL);

header('Content-Type: application/json; charset=utf-8');

$conexion = require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Modulo.php';

$modeloModulo = new Modulo($conexion);
$accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : '';

try {
    switch ($accion) {
        case 'listar':
            $data = $modeloModulo->obtenerTodos();
            echo json_encode(['success' => true, 'data' => $data]);
            break;

        case 'guardar':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
                $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
                $id = (isset($_POST['id']) && !empty($_POST['id'])) ? intval($_POST['id']) : null;

                if (empty($nombre) || empty($descripcion)) {
                    echo json_encode(['success' => false, 'message' => 'El nombre y la descripción son campos obligatorios.']);
                    exit();
                }

                if ($id === null) {
                    $res = $modeloModulo->crear($nombre, $descripcion);
                    if ($res === "duplicado") {
                        echo json_encode(['success' => false, 'message' => 'Ya existe un módulo con ese mismo nombre.']);
                    } elseif ($res) {
                        echo json_encode(['success' => true, 'message' => 'Módulo creado correctamente.']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error interno al insertar el módulo.']);
                    }
                } else {
                    if ($modeloModulo->editar($id, $nombre, $descripcion)) {
                        echo json_encode(['success' => true, 'message' => 'Módulo actualizado correctamente.']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error interno al actualizar el módulo.']);
                    }
                }
            }
            break;

        case 'eliminar':
            $id = isset($_POST['id']) ? intval($_POST['id']) : (isset($_GET['id']) ? intval($_GET['id']) : null);
            if ($id && $modeloModulo->eliminar($id)) {
                echo json_encode(['success' => true, 'message' => 'Módulo eliminado del sistema.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se pudo procesar la eliminación del registro.']);
            }
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Acción arquitectónica no válida o indefinida.']);
            break;
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error del servidor MVC: ' . $e->getMessage()]);
}
exit();