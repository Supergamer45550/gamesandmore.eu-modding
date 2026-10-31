<?php
// Read raw POST body
$payload = file_get_contents("php://input");

// Decode JSON
$data = json_decode($payload, true);

// Save commits to a file
$logfile = "/var/www/html/commits.json";
file_put_contents($logfile, json_encode($data, JSON_PRETTY_PRINT));

http_response_code(200);
echo "OK";
?>
