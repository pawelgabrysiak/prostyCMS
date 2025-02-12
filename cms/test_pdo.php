<?php
// Sprawdzanie dostępnych sterowników PDO na serwerze
// PDO (PHP DATA OBJECTS) to interfejs umożliwiający komunikację z różnymi bazami danych
print_r(PDO::getAvailableDrivers()); // Wyświetla listę dostępnych sterowników PDO (np. mysql, sqlite)
?>
