<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/BaseController.php';
$conexion = require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Modulo.php';

class ModuloController extends BaseController {
    private $modeloModulo;

    public function __construct($conexion) {
        parent::__construct();
        $this->modeloModulo = new Modulo($conexion);
    }

    public function procesarPeticion() {
        $accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : '';

        try {
            switch ($accion) {
                case 'listar':
                    $data = $this->modeloModulo->obtenerTodos();
                    $this->responderExito('', $data);
                    break;

                case 'guardar':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
                        $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
                        $id = (isset($_POST['id']) && !empty($_POST['id'])) ? intval($_POST['id']) : null;

                        if (empty($nombre) || empty($descripcion)) {
                            $this->responderError('El nombre y la descripción son campos obligatorios.');
                        }

                        if ($id === null) {
                            $res = $this->modeloModulo->crear($nombre, $descripcion);
                            if ($res === "duplicado") {
                                $this->responderError('Ya existe un módulo con ese mismo nombre.');
                            } elseif ($res) {
                                $this->responderExito('Módulo creado correctamente.');
                            } else {
                                $this->responderError('Error interno al insertar el módulo.');
                            }
                        } else {
                            if ($this->modeloModulo->editar($id, $nombre, $descripcion)) {
                                $this->responderExito('Módulo actualizado correctamente.');
                            } else {
                                $this->responderError('Error interno al actualizar el módulo.');
                            }
                        }
                    }
                    break;

                case 'eliminar':
                    $id = isset($_POST['id']) ? intval($_POST['id']) : (isset($_GET['id']) ? intval($_GET['id']) : null);
                    if ($id && $this->modeloModulo->eliminar($id)) {
                        $this->responderExito('Módulo eliminado del sistema.');
                    } else {
                        $this->responderError('No se pudo procesar la eliminación del registro.');
                    }
                    break;

                default:
                    $this->responderError('Acción arquitectónica no válida o indefinida.');
                    break;
            }
        } catch (Exception $e) {
            $this->responderError('Error del servidor MVC: ' . $e->getMessage());
        }
    }
}

$controlador = new ModuloController($conexion);
$controlador->procesarPeticion();
