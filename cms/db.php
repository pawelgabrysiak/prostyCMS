<?php
// Konfiguracja połączenia z bazą danych
$host = "127.0.0.1"; // Adres hosta (localhost lub 127.0.0.1 dla serwera lokalnego)
$dbname = "cms_db";  // Nazwa bazy danych
$username = "root";  // Nazwa użytkownika bazy danych (domyślnie root dla XAMPP)
$password = "";      // Hasło użytkownika (puste dla XAMPP)

// Próba nawiązania połączenia z bazą danych za pomocą PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Ustawienie atrybutu zgłaszania wyjątków dla błędów PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Jeśli wystąpi błąd podczas połączenia, skrypt zostanie zatrzymany i wyświetli komunikat błędu
    die("❌ Błąd połączenia: " . $e->getMessage());
}
?>
