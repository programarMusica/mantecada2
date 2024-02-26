﻿<?php
// Conexión a la base de datos

require_once 'pdo.php';


session_start();

// Validar si el usuario ha iniciado sesión
if (!isset($_SESSION["idusuario"])) {
    header("Location: iniciarSesion.php");
    exit;
}

$usuario = $_SESSION["idusuario"];

try {
    
    
    // Preparar la consulta SQL para obtener los pagos del usuario
    $stmt = $conn->prepare("SELECT * FROM pagos WHERE idusuario = ?");
    // Vincular el parámetro
    $stmt->bindParam(1, $usuario->idusuario);
    // Ejecutar la consulta
    $stmt->execute();
    // Obtener los registros de pagos
    $pagos = $stmt->fetchAll();
} catch (PDOException $e) {
    // Manejar el error de la base de datos
    echo "Error en la consulta: " . $e->getMessage();
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Pagos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Consultar Pagos</h1>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="salir.php">Salir</a>
    </nav>
</header>
<main>
    <section class="informacion-usuario">
        <h2>Bienvenido</h2>
        <?php
        echo "<p>¡Bienvenido {$usuario->nombre} {$usuario->apellidopaterno} {$usuario->apellidomaterno}!</p>";
        echo "<p>¡Has ingresado como {$usuario->tipousuario}!</p>";
        ?>
    </section>
    <section class="contenido">
        <h2>Registros de Pagos</h2>
        <table>
            <tr>
                <th>Folio de Pago</th>
                <th>Concepto</th>
                <th>Mes Pagado</th>
                <th>Monto</th>
                <th>Fecha de Pago</th>
            </tr>
            <?php foreach ($pagos as $pago): ?>
            <tr>
                <td><?php echo $pago['foliopago']; ?></td>
                <td><?php echo $pago['concepto']; ?></td>
                <td><?php echo $pago['mespagado']; ?></td>
                <td><?php echo $pago['monto']; ?></td>
                <td><?php echo $pago['fechapago']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>
</main>
<footer>
    <p>Colima, México 2024</p>
</footer>
</body>
</html>