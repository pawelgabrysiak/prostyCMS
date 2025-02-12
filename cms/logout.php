<?php
session_start(); // Rozpoczynanie sesji, aby uzyskać dostęp do istniejącej sesji użytkownika
session_destroy(); // Usuwanie wszystkich danych sesji (zniszczenie) - użytkownik zostaje wylogowywany
header("Location: login.php"); // Przekierowywanie użytkownika na stronę logowania
exit(); // Zakończenie skryptu, aby upewnić się że dalszy kod nie zostanie wykonany
?>
