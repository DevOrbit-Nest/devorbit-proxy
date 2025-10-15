<?php
// submit_form.php
$APPS_SCRIPT_URL = 'https://script.google.com/macros/s/AKfycbwqelcCXQ3vvmdEU3BamEwoNAI9wXRvLVqap8vgoxgNQpyvM73CKNhqzE2j4CzUA__kcg/exec';
$ALLOWED_ORIGIN = 'https://devorbit-nest.github.io';

header("Access-Control-Allow-Origin: $ALLOWED_ORIGIN");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}

$data = file_get_contents("php://input");

$ch = curl_init($APPS_SCRIPT_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // 👈 This is the fix
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

header("Access-Control-Allow-Origin: $ALLOWED_ORIGIN");
header("Content-Type: application/json");
echo $response;






