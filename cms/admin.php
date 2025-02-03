<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Administratora</title>
</head>
<body>
    <h2>Witaj w panelu administracyjnym!</h2>
    
    <a href="add_article.php">📝 Dodaj nowy artykuł</a>
    
    <h3>📌 Lista artykułów</h3>
    <ul>
        <?php
        $stmt = $pdo->query("SELECT id, title, image FROM articles ORDER BY created_at DESC");
        while ($article = $stmt->fetch()):
        ?>
        <li>
            <?php if (!empty($article['image'])): ?>
                <img src="uploads/<?= htmlspecialchars($article['image']) ?>" 
                     alt="Miniatura" 
                     style="width:50px; height:auto;">
            <?php endif; ?>

            <a href="article.php?id=<?= $article['id'] ?>">
                <?= htmlspecialchars($article['title']) ?>
            </a> |
            <a href="edit_article.php?id=<?= $article['id'] ?>">Edytuj</a> |
            <a href="delete_article.php?id=<?= $article['id'] ?>">Usuń</a>
        </li>
        <?php endwhile; ?>
    </ul>

    <a href="logout.php">🚪 Wyloguj</a>
</body>
</html>
