﻿<?php
// Conexión a la base de datos

require_once 'pdo.php';


// Validar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Almacenar los datos del formulario
    $idusuario = $_POST["idusuario"];
    $nombre = $_POST["nombre"];
    $apellidopaterno = $_POST["apellidopaterno"];
    $apellidomaterno = $_POST["apellidomaterno"];
    $edad = $_POST["edad"];
    $sexo = $_POST["sexo"];
    $email = $_POST["email"];
    $tipousuario = "PF"; // Tipo de usuario "Padres de Familia"
    $password = $_POST["password"];

    // Preparar la consulta SQL
    $stmt = $conn->prepare("INSERT INTO usuarios (idusuario, nombre, apellidopaterno, apellidomaterno, edad, sexo, email, tipousuario, password) 
                            VALUES (:idusuario, :nombre, :apellidopaterno, :apellidomaterno, :edad, :sexo, :email, :tipousuario, :password)");

    // Vincular los parámetros por nombre
    $stmt->bindValue(':idusuario', $idusuario);
    $stmt->bindValue(':nombre', $nombre);
    $stmt->bindValue(':apellidopaterno', $apellidopaterno);
    $stmt->bindValue(':apellidomaterno', $apellidomaterno);
    $stmt->bindValue(':edad', $edad);
    $stmt->bindValue(':sexo', $sexo);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':tipousuario', $tipousuario);
    $stmt->bindValue(':password', $password);

    // Ejecutar la consulta
    $stmt->execute();

    // Mostrar mensaje de éxito
    $mensaje = "¡Usuario registrado exitosamente!";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Registro de Usuario</h1>
</header>
<main>
    <section class="formulario">
        <h2>Ingrese sus datos</h2>
        <?php if(isset($mensaje)): ?>
            <p><?php echo $mensaje; ?></p>
        <?php endif; ?>
        <form action="registro.php" method="post">
            <label for="idusuario">ID Usuario:</label>
            <input type="text" id="idusuario" name="idusuario" required>
            <br>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <br>
            <label for="apellidopaterno">Apellido Paterno:</label>
            <input type="text" id="apellidopaterno" name="apellidopaterno" required>
            <br>
            <label for="apellidomaterno">Apellido Materno:</label>
            <input type="text" id="apellidomaterno" name="apellidomaterno" required>
            <br>
            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" required>
            <br>
            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo" required>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <br>
            <button type="submit">Registrarse</button>
        </form>
    </section>
</main>
<footer>
    <p>Colima, México 2024</p>
</footer>
</body>
</html>

