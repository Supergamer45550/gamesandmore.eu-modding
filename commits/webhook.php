<?php
$payload = file_get_contents("php://input");
$data = json_decode($payload, true);

$logfile = "/var/www/gamesandmore/modding/commits/commits.json";

// Load existing history
$existing = [];
if (file_exists($logfile)) {
    $existing = json_decode(file_get_contents($logfile), true);
    if (!is_array($existing)) {
        $existing = [];
    }
}

// Extract commits from GitHub payload
$newCommits = [];
if (isset($data["commits"])) {
    foreach ($data["commits"] as $commit) {
        $newCommits[] = [
            "author" => $commit["author"]["name"],
            "message" => $commit["message"],
            "timestamp" => $commit["timestamp"]
        ];
    }
}

// Merge: newest commits first
$merged = array_merge($newCommits, $existing);

// Save back to JSON
file_put_contents($logfile, json_encode($merged, JSON_PRETTY_PRINT));

http_response_code(200);
echo "OK";
?>
