<?php

class Modulo {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function obtenerTodos() {
        $query = "SELECT * FROM modulos ORDER BY fecha_creacion ASC";
        $result = $this->db->query($query);
        $modulos = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $modulos[] = $row;
            }
        }
        return $modulos;
    }


    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM modulos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }


    public function crear($nombre, $descripcion) {
        $stmtCheck = $this->db->prepare("SELECT id FROM modulos WHERE nombre = ?");
        $stmtCheck->bind_param("s", $nombre);
        $stmtCheck->execute();
        if ($stmtCheck->get_result()->num_rows > 0) {
            return "duplicado";
        }

        $stmt = $this->db->prepare("INSERT INTO modulos (nombre, descripcion, fecha_creacion) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $nombre, $descripcion);
        return $stmt->execute();
    }


    public function editar($id, $nombre, $descripcion) {
        $stmt = $this->db->prepare("UPDATE modulos SET nombre = ?, descripcion = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nombre, $descripcion, $id);
        return $stmt->execute();
    }


    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM modulos WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}