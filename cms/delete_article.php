<?php
session_start();
require 'db.php';

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit();
}

// Sprawdzenie, czy podano ID artykułu
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Usuń artykuł z bazy danych
    $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->execute([$id]);

    // Przekierowanie do panelu administratora
    header("Location: admin.php");
    exit();
} else {
    echo "Błąd: Nie podano ID artykułu.";
}
?>
