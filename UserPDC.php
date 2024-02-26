<?php
// Conexión a la base de datos

require_once 'pdo.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User & Payment List</title>
</head>
<body>
    <h1>Acciones Disponibles</h1>
    <form action="redirect.php" method="post">
        <label for="action">Selecciona una acción:</label>
        <select name="action" id="action">
            <option value="consultar">Consultar Usuarios y Pagos</option>
            <option value="editar">Editar Usuarios y Pagos</option>
            <option value="capturar">Capturar Nuevo Registro</option>
            <option value="eliminar">Eliminar Registro</option>
        </select>
        <button type="submit">Ir</button>
    </form>
</body>
</html>