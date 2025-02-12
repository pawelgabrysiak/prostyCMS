<?php
require 'db.php';

// Pobranie artykułów z bazy
$stmt = $pdo->query("SELECT id, title, summary FROM articles ORDER BY created_at DESC");
$articles = $stmt->fetchAll(); // Pobranie wszystkich wyników zapytania jako tablica
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista artykułów</title>
</head>
<body>
    <h2>Lista artykułów</h2>
    <!-- Iteracja przez każdy artykuł i wyświetlanie jego tytułu i streszczenia -->
    <?php foreach ($articles as $article): ?>
        <div>
            <!-- Link do pełnego artykułu -->
            <h3><a href="article.php?id=<?= $article['id'] ?>"><?= htmlspecialchars($article['title']) ?></a></h3> <!-- Wyświetlenie tytułu >>
            <p><?= htmlspecialchars($article['summary']) ?></p> <!-- Wyświetlenie streszczenia -->
        </div>
    <?php endforeach; ?>
    <hr>
    <!-- Link powrotny do panelu -->
<a href="admin.php">🔙 Powrót do panelu administratora</a>

</body>
</html>
