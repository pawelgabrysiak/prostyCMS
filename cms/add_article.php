<?php
session_start(); // Rozpoczyna sesje
require 'db.php'; // Połączenie i konfiguracja z bazą danych

// Sprawdzanie, czy formularz został pobrany metodą POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $format = $_POST['format'];
    $image = null;
// Pobieranie danych wpisanych z pola formularza, tytuł, streszczenie, treść artykułu, format wyświetlania oraz opcjonalne zdjęcie

    // Obsługa przesyłania zdjęcia
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "uploads/";
        $image = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image);
    }
    // Jeśli użytkownik doda zdjęcie, to zapisuje jego ścieżkę (uploads/nazwa_pliku), następnie przenosi z folderu tymczasowego do uploads/


    // Wstawianie danych do bazy danych
    $stmt = $pdo->prepare("INSERT INTO articles (title, summary, content, image, format, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$title, $summary, $content, $image, $format]);
    // Wstawianie danych artykułu do tabeli articles, ustawiając bieżącą datę i godzinę jako created_at

    header("Location: admin.php"); // Przenoszenie użytkownika z powrotem do panelu admina "admin.php"
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj artykuł</title>
</head>
<body>

<h2>Dodaj artykuł</h2>
<form action="add_article.php" method="post" enctype="multipart/form-data"> 
    <input type="text" name="title" placeholder="Tytuł" required>
    <input type="text" name="summary" placeholder="Streszczenie" required>
    <textarea name="content" placeholder="Treść artykułu" required></textarea>

    <label for="image">Dodaj zdjęcie:</label>
    <input type="file" name="image" accept="image/*">

    <label for="format">Wybierz format wyświetlania:</label>
    <select name="format" required>
        <option value="top-image">Zdjęcie na górze</option>
        <option value="text-wrap">Tekst opływający zdjęcie</option>
        <option value="no-image">Bez zdjęcia</option>
    </select>

    <button type="submit">Dodaj artykuł</button>
</form>

<a href="admin.php">Powrót do panelu</a>

</body>
</html>
