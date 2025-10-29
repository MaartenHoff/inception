<?php
$mysqli = new mysqli("db", "root", "root", "testdb");
if ($mysqli->connect_errno) {
    echo "Fehler beim Verbinden mit MySQL: " . $mysqli->connect_error;
    exit();
}

// Tabelle erstellen, falls nicht existiert
$mysqli->query("CREATE TABLE IF NOT EXISTS notes (id INT AUTO_INCREMENT PRIMARY KEY, text VARCHAR(255))");

// Wenn Formular abgeschickt
if (isset($_POST['text'])) {
    $text = $mysqli->real_escape_string($_POST['text']);
    $mysqli->query("INSERT INTO notes (text) VALUES ('$text')");
}

// Alle Einträge auslesen
$result = $mysqli->query("SELECT * FROM notes");

?>
<h1>Inception Notes</h1>
<form method="post">
    <input type="text" name="text">
    <button type="submit">Add</button>
</form>
<ul>
<?php while($row = $result->fetch_assoc()): ?>
    <li><?= htmlspecialchars($row['text']) ?></li>
<?php endwhile; ?>
</ul>
