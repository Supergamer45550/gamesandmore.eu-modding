<?php
$data = json_decode(file_get_contents("commits.json"), true);

echo "<h1>Latest Commits</h1>";

foreach ($data["commits"] as $commit) {
    echo "<div>";
    echo "<strong>" . $commit["author"]["name"] . "</strong><br>";
    echo $commit["message"] . "<br>";
    echo "<small>" . $commit["timestamp"] . "</small>";
    echo "<hr>";
    echo "</div>";
}
?>
