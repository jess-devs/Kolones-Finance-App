<?php

function getConexion(): PDO {
    $host     = getenv('MYSQLHOST');
    $port     = getenv('MYSQLPORT') ?: '3306';
    $database = getenv('MYSQLDATABASE');
    $user     = getenv('MYSQLUSER');
    $password = getenv('MYSQLPASSWORD');

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
        echo json_encode(['mensaje' => 'Error de conexion a la base de datos']);
        exit;
    }
}
