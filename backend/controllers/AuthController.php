<?php

require_once __DIR__ . '/../models/User.php';

class AuthController {

    private User $user;

    public function __construct() {
        $this->user = new User();
    }

    public function registro(array $datos): array {
        $nombre    = trim($datos['nombre'] ?? '');
        $correo    = trim($datos['correo'] ?? '');
        $contrasena = $datos['contrasena'] ?? '';
        $confirmar  = $datos['confirmar'] ?? '';

        if (!$nombre || !$correo || !$contrasena || !$confirmar) {
            return ['exito' => false, 'mensaje' => 'Todos los campos son requeridos'];
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return ['exito' => false, 'mensaje' => 'Correo invalido'];
        }

        if (strlen($contrasena) < 8) {
            return ['exito' => false, 'mensaje' => 'La contrasena debe tener al menos 8 caracteres'];
        }

        if ($contrasena !== $confirmar) {
            return ['exito' => false, 'mensaje' => 'Las contrasenas no coinciden'];
        }

        if ($this->user->existeCorreo($correo)) {
            return ['exito' => false, 'mensaje' => 'El correo ya esta registrado'];
        }

        $id = $this->user->crear($nombre, $correo, $contrasena);

        session_start();
        $_SESSION['usuario_id']     = $id;
        $_SESSION['usuario_nombre'] = $nombre;

        return ['exito' => true, 'mensaje' => 'Cuenta creada exitosamente'];
    }

    public function login(array $datos): array {
        $correo    = trim($datos['correo'] ?? '');
        $contrasena = $datos['contrasena'] ?? '';

        if (!$correo || !$contrasena) {
            return ['exito' => false, 'mensaje' => 'Todos los campos son requeridos'];
        }

        $usuario = $this->user->buscarPorCorreo($correo);

        if (!$usuario || !$this->user->verificarContrasena($contrasena, $usuario['contrasena'])) {
            return ['exito' => false, 'mensaje' => 'Credenciales incorrectas'];
        }

        session_start();
        $_SESSION['usuario_id']     = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];

        return ['exito' => true, 'mensaje' => 'Sesion iniciada'];
    }

    public function logout(): void {
        session_start();
        session_destroy();
    }
}