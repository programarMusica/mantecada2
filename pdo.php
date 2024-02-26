<?php
// Datos de conexión a la base de datos
$servername = "localhost"; 
$username = "sajacolima"; 
$password = "Colim@1234#@1234"; 
$dbname = "i9781293_nluk1"; 

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

