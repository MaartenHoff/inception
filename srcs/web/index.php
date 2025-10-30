<?php
$mysqli = new mysqli("db", "root", "root", "testdb");
$mysqli->query("CREATE TABLE IF NOT EXISTS notes (id INT AUTO_INCREMENT PRIMARY KEY, text VARCHAR(255))");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $stmt = $mysqli->prepare("DELETE FROM notes WHERE id=?");
        $stmt->bind_param("i", $_POST['delete']);
        $stmt->execute();
    } elseif (isset($_POST['update'], $_POST['text'])) {
        $stmt = $mysqli->prepare("UPDATE notes SET text=? WHERE id=?");
        $stmt->bind_param("si", $_POST['text'], $_POST['update']);
        $stmt->execute();
    } elseif (!empty($_POST['new'])) {
        $stmt = $mysqli->prepare("INSERT INTO notes (text) VALUES (?)");
        $stmt->bind_param("s", $_POST['new']);
        $stmt->execute();
    }
    header("Location: /");
    exit();
}

$result = $mysqli->query("SELECT * FROM notes ORDER BY id DESC");
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Notes</title></head>
<body>
<h1>Inception Notes</h1>

<form method="post">
  <input name="new" placeholder="Neuer Eintrag">
  <button>+</button>
</form>

<ul>
<?php while($row = $result->fetch_assoc()): ?>
<li>
  <form method="post" style="display:inline">
    <input name="text" value="<?=htmlspecialchars($row['text'])?>">
    <button name="update" value="<?=$row['id']?>">💾</button>
    <button name="delete" value="<?=$row['id']?>">🗑</button>
  </form>
</li>
<?php endwhile; ?>
</ul>
</body>
</html>
