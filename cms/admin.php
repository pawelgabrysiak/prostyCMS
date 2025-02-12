<?php
session_start(); // Rozpoczyna sesję, aby sprawdzić czy użytkownik jest zalogowany jako admin
require 'db.php'; // Łączenie z bazą danych

// Sprawdzenie, czy użytkownik jest zalogowany jako admin
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

    <!-- Link do dodawania nowego artykułu -->
    <a href="add_article.php">📝 Dodaj nowy artykuł</a>
    
    <h3>📌 Lista artykułów</h3>
    <ul>
        <?php
        // Pobiera listę artykułow, sortując je według daty dodania (najnowsze pierwsze)
        $stmt = $pdo->query("SELECT id, title, image FROM articles ORDER BY created_at DESC");
        while ($article = $stmt->fetch()):
        ?>
        <li>
            <!-- Wyświetla miniaturę zdjęcia, jeśli artykuł ma przypisane zdjęcie -->
            <?php if (!empty($article['image'])): ?>
                <img src="uploads/<?= htmlspecialchars($article['image']) ?>" 
                     alt="Miniatura" 
                     style="width:50px; height:auto;">
            <?php endif; ?>
            <!-- Link do pełnego artykułu -->
            <a href="article.php?id=<?= $article['id'] ?>">
                <?= htmlspecialchars($article['title']) ?>
            </a> |
            <!-- Link do edytowania artykułu -->
            <a href="edit_article.php?id=<?= $article['id'] ?>">Edytuj</a> |
            <!-- Link do usuwania artykułu -->
            <a href="delete_article.php?id=<?= $article['id'] ?>">Usuń</a>
        </li>
        <?php endwhile; ?>
    </ul>
    <!-- Link do wylogowywania się z panelu -->
    <a href="logout.php">🚪 Wyloguj</a>
</body>
</html>
