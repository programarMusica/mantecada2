<?php
// Datos de conexión a la base de datos
$servername = "127.0.0.1"; 
$username = "root"; 
$password = ""; 
$dbname = "mantecada"; 

try {
    // Crear conexión PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Configurar el modo de error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Opcional: configurar el juego de caracteres a UTF-8
    $conn->exec("SET NAMES 'utf8'");
} catch(PDOException $e) {
    // En caso de error, mostrar mensaje y terminar el script
    die("Error de conexión: " . $e->getMessage());
}
?>

