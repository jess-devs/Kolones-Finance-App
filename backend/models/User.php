<?php

require_once __DIR__ . '/../config/database.php';

class User {

    private PDO $db;

    public function __construct() {
        $this->db = getConexion();
    }

    public function existeCorreo(string $correo): bool {
        $stmt = $this->db->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        return $stmt->fetch() !== false;
    }

    public function crear(string $nombre, string $correo, string $contrasena): int {
        $hash = password_hash($contrasena, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare(
            "INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)"
        );
        $stmt->execute([$nombre, $correo, $hash]);
        return (int) $this->db->lastInsertId();
    }

    public function buscarPorCorreo(string $correo): array|false {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        return $stmt->fetch();
    }

    public function verificarContrasena(string $contrasena, string $hash): bool {
        return password_verify($contrasena, $hash);
    }
}