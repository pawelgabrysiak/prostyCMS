<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = md5(trim($_POST['password'])); 

    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $error = "Login może zawierać tylko litery, cyfry i podkreślenia.";
    } else {
        try {
            // Pobieranie użytkownika z bazy danych
            $stmt = $pdo->prepare("SELECT id, username FROM users WHERE username = ? AND password = ?");
            $stmt->execute([$username, $password]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Jeśli znaleziono użytkownika
            if ($user) {
                $_SESSION['admin'] = true;
                $_SESSION['username'] = $user['username'];
                header("Location: admin.php"); // Przekierowanie do panelu admina
                exit();
            } else {
                $error = "Nieprawidłowe dane logowania.";
            }
        } catch (PDOException $e) {
            $error = "Błąd serwera: " . $e->getMessage();
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
    <form method="post">
        <input type="text" name="username" placeholder="Login" required>
        <input type="password" name="password" placeholder="Hasło" required>
        <button type="submit">Zaloguj</button>
    </form>
    <?php if (isset($error)) echo "<p style='color:red;'>" . htmlspecialchars($error) . "</p>"; ?>
</body>
</html>
