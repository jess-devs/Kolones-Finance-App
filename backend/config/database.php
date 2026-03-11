<?php

function getConexion(): PDO
{
    $host     = $_ENV['MYSQLHOST']     ?? getenv('MYSQLHOST');
    $port     = $_ENV['MYSQLPORT']     ?? getenv('MYSQLPORT') ?: '3306';
    $database = $_ENV['MYSQLDATABASE'] ?? getenv('MYSQLDATABASE');
    $user     = $_ENV['MYSQLUSER']     ?? getenv('MYSQLUSER');
    $password = $_ENV['MYSQLPASSWORD'] ?? getenv('MYSQLPASSWORD');

    $dsn = "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false
        ]);
        return $pdo;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode([
            'mensaje' => 'Error de conexion a la base de datos',
            'detalle' => $e->getMessage()
        ]);
        exit;
    }
}
