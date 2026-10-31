<?php
try {
    $payload = file_get_contents("php://input");
    file_put_contents("/var/www/gamesandmore/modding/commits/db/debug.log", "RAW:\n" . $payload . "\n\n", FILE_APPEND);

    $data = json_decode($payload, true);

    $dbPath = "/var/www/gamesandmore/modding/commits/db/commits.db";
    $db = new PDO("sqlite:" . $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare("INSERT INTO commits (author, message, timestamp) VALUES (:author, :message, :timestamp)");

    if (!isset($data["commits"])) {
        throw new Exception("No commits field in payload");
    }

    foreach ($data["commits"] as $commit) {
        $stmt->execute([
            ":author" => $commit["author"]["name"] ?? "unknown",
            ":message" => $commit["message"] ?? "",
            ":timestamp" => $commit["timestamp"] ?? date("c")
        ]);
    }

    http_response_code(200);
    echo "OK";

} catch (Exception $e) {
    file_put_contents("/var/www/gamesandmore/modding/commits/db/error.log", $e->getMessage() . "\n", FILE_APPEND);
    http_response_code(500);
    echo "ERROR";
}
?>
