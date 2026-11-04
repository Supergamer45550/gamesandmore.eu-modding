<?php
date_default_timezone_set("Europe/Berlin");

$dbPath = "/var/www/gamesandmore/modding/commits/db/commits.db";
$db = new PDO("sqlite:" . $dbPath);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$rows = $db->query("SELECT author, message, timestamp, url FROM commits ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

echo "<h1>Latest Commit</h1>";

if (count($rows) > 0) {
    $latest = $rows[0];

    try {
        $dt = new DateTime($latest["timestamp"]);
    } catch (Exception $e) {
        $dt = new DateTime();
    }

    $date = $dt->format("d M Y, H:i (P)");

    echo "<div style='margin-bottom:20px; padding:10px; border:1px solid #ccc; border-radius:8px; background:#f9f9f9;'>";
    echo "<p><strong>Author:</strong> " . htmlspecialchars($latest["author"]) . "</p>";
    echo "<p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($latest["message"])) . "</p>";
    echo "<p><strong>Date:</strong> " . $date . "</p>";

    if (!empty($latest["url"])) {
        echo "<p><a href='" . htmlspecialchars($latest["url"]) . "' target='_blank'>View on GitHub</a></p>";
    }

    echo "</div>";
}


echo "<h1>Earlier Commits</h1>";


for ($i = 1; $i < count($rows); $i++) {
    $commit = $rows[$i];

    try {
        $dt = new DateTime($commit["timestamp"]);
    } catch (Exception $e) {
        $dt = new DateTime(); 
    }

    $date = $dt->format("d M Y, H:i (P)");

    echo "<div style='margin-bottom:20px; padding:10px; border:1px solid #ccc; border-radius:8px; background:#f9f9f9;'>";
    echo "<p><strong>Author:</strong> " . htmlspecialchars($commit["author"]) . "</p>";
    echo "<p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($commit["message"])) . "</p>";
    echo "<p><strong>Date:</strong> " . $date . "</p>";

    if (!empty($commit["url"])) {
        echo "<p><a href='" . htmlspecialchars($commit["url"]) . "' target='_blank'>View on GitHub</a></p>";
    }

    echo "</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Github Commits - gamesandmore.eu modding</title>
</head>
</html>