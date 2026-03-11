<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['mensaje' => 'Metodo no permitido']);
    exit;
}

$datos  = json_decode(file_get_contents('php://input'), true) ?? [];
$accion = $datos['accion'] ?? '';

$controller = new AuthController();

$resultado = match($accion) {
    'registro' => $controller->registro($datos),
    'login'    => $controller->login($datos),
    'logout'   => (function() use ($controller) {
        $controller->logout();
        return ['exito' => true, 'mensaje' => 'Sesion cerrada'];
    })(),
    default => ['exito' => false, 'mensaje' => 'Accion no reconocida']
};

echo json_encode($resultado);