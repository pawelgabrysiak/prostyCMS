<?php
require 'db.php';

// Pobranie artykułów z bazy
$stmt = $pdo->query("SELECT id, title, summary FROM articles ORDER BY created_at DESC");
$articles = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista artykułów</title>
</head>
<body>
    <h2>Lista artykułów</h2>
    <?php foreach ($articles as $article): ?>
        <div>
            <h3><a href="article.php?id=<?= $article['id'] ?>"><?= htmlspecialchars($article['title']) ?></a></h3>
            <p><?= htmlspecialchars($article['summary']) ?></p>
        </div>
    <?php endforeach; ?>
    <hr>
<a href="admin.php">🔙 Powrót do panelu administratora</a>

</body>
</html>
