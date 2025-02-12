<?php
session_start(); // Rozpoczynanie sesji
require 'db.php'; // Połączenie z bazą danych

// Sprawdzenie, czy formularz został przesłany metodą POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']); // Pobranie i oczyszczenie loginu
    $password = md5(trim($_POST['password'])); // Pobranie i zaszyfrowanie hasła za pomocą funkcji md5

    // Walidacja loginu (tylko litery, cyfry i podkreślenia)
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $error = "Login może zawierać tylko litery, cyfry i podkreślenia.";
    } else {
        try {
            // Przygotowywanie zapytania SQL w celu znalezienia użytkownika
            $stmt = $pdo->prepare("SELECT id, username FROM users WHERE username = ? AND password = ?");
            $stmt->execute([$username, $password]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC); // Pobranie użytkownika jako tablica asocjacyjna

            // Jeśli znaleziono użytkownika
            if ($user) {
                $_SESSION['admin'] = true; // Ustawienie sesji administratora
                $_SESSION['username'] = $user['username']; // Zapisywanie loginu użytkownika w sesji
                header("Location: admin.php"); // Przekierowanie do panelu admina
                exit();
            } else {
                $error = "Nieprawidłowe dane logowania.";
            }
        } catch (PDOException $e) {
            $error = "Błąd serwera: " . $e->getMessage(); // Obsługa błędu połączenia
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
</head>
<body>
    <h2>Logowanie do panelu administracyjnego</h2>
    <!-- Formularz logowania -->
    <form method="post">
        <input type="text" name="username" placeholder="Login" required> <!-- Pole na login -->
        <input type="password" name="password" placeholder="Hasło" required> <!-- Pole na hasło -->
        <button type="submit">Zaloguj</button> <!-- Przycisk -->
    </form>
    <!-- Wyświetlanie błędu jeśli istnieje -->
    <?php if (isset($error)) echo "<p style='color:red;'>" . htmlspecialchars($error) . "</p>"; ?>
</body>
</html>
