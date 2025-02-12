<?php
require 'db.php'; // Połączenie z bazą danych

// Pobranie ID artykułu z parametru GET
if (!isset($_GET['id'])) {
    die("Błąd: Nie podano ID artykułu."); // Zatrzymanie skryptu jeśli ID nie jest przekazane
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?"); // Przygotowywanie zapytania, aby pobrać artykuł o wskazanym ID
$stmt->execute([$id]);
$article = $stmt->fetch();

// Sprawdzenie, czy artykuł istnieje
if (!$article) {
    die("Artykuł nie istnieje."); // Zatrzymanie skryptu, jeśli artykuł nie zostanie znaleziony
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['title']) ?></title>
    <style>
        /* Styl dla formatu, zdjęcia na górze*/
        .top-image img { 
        width: auto; 
        max-width: 100%; 
        height: auto; 
        display: block;
        margin: 0 auto; 
        max-height: 500px; 
        object-fit: contain; 
    }

        /* Styl dla formatu, tekst opływający zdjęcie*/
    .text-wrap { 
        display: flex; 
        align-items: flex-start; 
        gap: 20px; 
    }
    
    .text-wrap img { 
        max-width: 40%; 
        height: auto; 
        border-radius: 5px; 
    }
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($article['title']) ?></h1> <!-- Nagłówek z tytułem artykułu -->

    <?php if (!empty($article['image']) && $article['format'] !== 'no-image'): ?>
    <!-- Sprawdzenie czy artykuł zawiera obrazek i czy wybrano format z obrazem -->
        <?php if ($article['format'] === 'top-image'): ?>
            <div class="top-image">
                <img src="uploads/<?= htmlspecialchars($article['image']) ?>" alt="Obraz artykułu">
            </div>
            <p><?= nl2br(htmlspecialchars($article['content'])) ?></p> <!-- 📌 DODANE WYŚWIETLANIE TEKSTU -->
        <?php elseif ($article['format'] === 'text-wrap'): ?>
            <div class="text-wrap">
                <img src="uploads/<?= htmlspecialchars($article['image']) ?>" alt="Obraz artykułu">
                <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>
            </div>
        <?php endif; ?>
    <?php else: ?>
    <!-- Jeśli nie ma obrazu, lub wybranu opcje bez obrazu, wyświetlana jest tylko treść artykułu -->
        <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>
    <?php endif; ?>

    <!-- Link powrotny do listy artykułów -->
    <a href="index.php">Powrót do listy</a> 
</body>
</html>
