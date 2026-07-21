<?php

abstract class BaseModel {
    protected $db;

    
    public function __construct($conexion) {
        if (!$conexion) {
            throw new Exception("Conexión de base de datos no válida en BaseModel.");
        }
        $this->db = $conexion;
    }
}