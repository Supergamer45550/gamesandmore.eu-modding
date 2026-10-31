<?php
$data = json_decode(file_get_contents("commits.json"), true);

echo "<h1>Latest Commits</h1>";

foreach ($data as $commit) {
    $date = date("d M Y, H:i", strtotime($commit["timestamp"]));

    echo "<div style='margin-bottom:20px; padding:10px; border:1px solid #ccc; border-radius:8px; background:#f9f9f9;'>";

    echo "<p><strong>Author:</strong> " . htmlspecialchars($commit["author"]) . "</p>";
    echo "<p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($commit["message"])) . "</p>";
    echo "<p><strong>Date:</strong> " . $date . "</p>";

    echo "</div>";
}
?>
