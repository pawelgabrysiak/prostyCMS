<?php
session_start();
require 'db.php';

// Sprawdzenie, czy użytkownik jest adminem
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit();
}

// Pobranie ID artykułu
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
    $stmt->execute([$id]);
    $article = $stmt->fetch();
} else {
    die("Błąd: Nie podano ID artykułu.");
}

// Aktualizacja artykułu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $format = $_POST['format'];
    $image = $article['image']; // Domyślnie zachowuje stare zdjęcie

    // Usunięcie zdjęcia, jeśli użytkownik zaznaczył checkbox
    if (isset($_POST['remove_image']) && $_POST['remove_image'] == 1) {
        $image = null;
    }

    // Obsługa nowego zdjęcia
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        $image = basename($_FILES['image']['name']);
        $target_file = $target_dir . $image;

        // Sprawdzenie i przeniesienie pliku
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            echo "Plik przesłany pomyślnie.";
        } else {
            echo "Błąd przesyłania pliku.";
        }
    }

    // Aktualizacja artykułu w bazie danych
    $stmt = $pdo->prepare("UPDATE articles SET title = ?, summary = ?, content = ?, format = ?, image = ? WHERE id = ?");
    $stmt->execute([$title, $summary, $content, $format, $image, $id]);

    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj artykuł</title>
</head>
<body>
    <h2>Edytuj artykuł</h2>
    <form method="post" enctype="multipart/form-data">
        <label>Tytuł:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($article['title']) ?>" required><br>

        <label>Streszczenie:</label>
        <textarea name="summary" required><?= htmlspecialchars($article['summary']) ?></textarea><br>

        <label>Treść:</label>
        <textarea name="content" required><?= htmlspecialchars($article['content']) ?></textarea><br>

        <!-- Opcja zmiany formatu obrazu -->
        <label>Format obrazu:</label>
        <select name="format">
            <option value="top-image" <?= $article['format'] === 'top-image' ? 'selected' : '' ?>>Obrazek na górze</option>
            <option value="text-wrap" <?= $article['format'] === 'text-wrap' ? 'selected' : '' ?>>Tekst opływający obraz</option>
            <option value="no-image" <?= $article['format'] === 'no-image' ? 'selected' : '' ?>>Brak obrazu</option>
        </select>
        <br>

        <!-- Podgląd obecnego zdjęcia -->
        <?php if (!empty($article['image'])): ?>
            <p>Obecne zdjęcie:</p>
            <img src="uploads/<?= htmlspecialchars($article['image']) ?>" alt="Obraz artykułu" style="max-width: 200px;"><br>
            <input type="checkbox" name="remove_image" value="1"> Usuń obecne zdjęcie<br>
        <?php endif; ?>

        <!-- Dodanie nowego zdjęcia -->
        <label>Dodaj nowe zdjęcie:</label>
        <input type="file" name="image"><br>

        <button type="submit">Zapisz zmiany</button>
    </form>
    <a href="admin.php">Powrót</a>
</body>
</html>
