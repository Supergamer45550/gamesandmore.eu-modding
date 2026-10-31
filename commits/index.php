<?php
$dbPath = "/var/www/gamesandmore/modding/commits/db/commits.db";
$db = new PDO("sqlite:" . $dbPath);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch newest first
$rows = $db->query("SELECT author, message, timestamp FROM commits ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

echo "<h1>Latest Commits</h1>";

foreach ($rows as $commit) {
    $date = date("d M Y, H:i", strtotime($commit["timestamp"]));

    echo "<div style='margin-bottom:20px; padding:10px; border:1px solid #ccc; border-radius:8px; background:#f9f9f9;'>";

    echo "<p><strong>Author:</strong> " . htmlspecialchars($commit["author"]) . "</p>";
    echo "<p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($commit["message"])) . "</p>";
    echo "<p><strong>Date:</strong> " . $date . "</p>";

    echo "</div>";
}
?>
