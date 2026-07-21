<?php

abstract class BaseController {
    
    public function __construct() {
        if (!headers_sent()) {
            header('Content-Type: application/json; charset=utf-8');
        }
    }

    protected function responderExito($mensaje = '', $data = null) {
        $respuesta = ['success' => true];
        
        if (!empty($mensaje)) {
            $respuesta['message'] = $mensaje;
        }
        if ($data !== null) {
            $respuesta['data'] = $data;
        }

        echo json_encode($respuesta);
        exit();
    }

    protected function responderError($mensaje) {
        echo json_encode([
            'success' => false,
            'message' => $mensaje
        ]);
        exit();
    }
}