<?php
// Conexión a la base de datos

require_once 'pdo.php';


session_start();

// Validar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
  header("Location: iniciarSesion.php");
  exit;
}


// Si se ha enviado el formulario de usuario
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit_usuario"])) {
  // Almacenar los datos del formulario de usuario
  $idusuario = $_POST["idusuario"];
  $nombre = $_POST["nombre"];
  $apellidopaterno = $_POST["apellidopaterno"];
  $apellidomaterno = $_POST["apellidomaterno"];
  $edad = $_POST["edad"];
  $sexo = $_POST["sexo"];
  $email = $_POST["email"];
  $tipousuario = $_POST["tipousuario"];
  $password = $_POST["password"];

  // Preparar la consulta SQL para insertar un nuevo usuario
  $stmt = $conn->prepare("INSERT INTO usuarios (idusuario, nombre, apellidopaterno, apellidomaterno, edad, sexo, email, tipousuario, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

  // Vincular los parámetros
  $stmt->bindParam(1, $idusuario);
  $stmt->bindParam(2, $nombre);
  $stmt->bindParam(3, $apellidopaterno);
  $stmt->bindParam(4, $apellidomaterno);
  $stmt->bindParam(5, $edad);
  $stmt->bindParam(6, $sexo);
  $stmt->bindParam(7, $email);
  $stmt->bindParam(8, $tipousuario);
  $stmt->bindParam(9, $password);

  // Ejecutar la consulta
  $stmt->execute();

  // Mostrar un mensaje de éxito
  echo "<p>Usuario agregado exitosamente.</p>";
}

// Si se ha enviado el formulario de pago
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit_pago"])) {
  // Almacenar los datos del formulario de pago
  $idusuario = $_POST["idusuario"];
  $foliopago = $_POST["foliopago"];
  $concepto = $_POST["concepto"];
  $mespagado = $_POST["mespagado"];
  $monto = $_POST["monto"];
  $fechapago = $_POST["fechapago"];

  // Preparar la consulta SQL para insertar un nuevo pago
  $stmt = $conn->prepare("INSERT INTO pagos (idusuario, foliopago, concepto, mespagado, monto, fechapago) VALUES (?, ?, ?, ?, ?, ?)");

  // Vincular los parámetros
  $stmt->bindParam(1, $idusuario);
  $stmt->bindParam(2, $foliopago);
  $stmt->bindParam(3, $concepto);
  $stmt->bindParam(4, $mespagado);
  $stmt->bindParam(5, $monto);
  $stmt->bindParam(6, $fechapago);

  // Ejecutar la consulta
  $stmt->execute();

  // Mostrar un mensaje de éxito
  echo "<p>Pago registrado exitosamente.</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Capturar Usuario y Pago</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Capturar Nuevo Usuario y Pago</h1>
    <nav>
      <a href="index.php">Inicio</a>
      <a href="consultar.php?opcion=consultar">Consultar</a>
      <a href="capturar.php?opcion=capturar">Capturar</a>
      <a href="editar.php?opcion=editar">Editar</a>
      <a href="eliminar.php?opcion=eliminar">Eliminar</a>
      <a href="salir.php">Salir</a>
    </nav>
  </header>
  <main>
    <section class="formulario">
      <h2>Ingrese los datos del nuevo usuario</h2>
      <form action="capturar.php" method="post">

        <label for="idusuario">idusuario:</label>
        <input type="string" id="idusuario" name="idusuario" required>

        <label for="nombre">nombre:</label>
        <input type="string" id="nombre" name="nombre" required>

        <label for="apellidopaterno">apellidopaterno:</label>
        <input type="string" id="apellidopaterno" name="apellidopaterno" required>

        <label for="apellidomaterno">apellidomaterno:</label>
        <input type="string" id="apellidomaterno" name="apellidomaterno" required>

        <label for="edad">edad:</label>
        <input type="int" id="edad" name="edad" required>

        <label for="sexo">sexo:</label>
        <input type="string" id="sexo" name="sexo" required>

        <label for="tipousuario">tipousuario:</label>
        <input type="string" id="tipousuario" name="tipousuario" required>

        <label for="password">password:</label>
        <input type="string" id="password" name="password" required>

        <button type="submit" name="submit_usuario">Agregar Usuario</button>
      </form>
    </section>

    <section class="formulario">
      <h2>Ingrese los datos del nuevo pago</h2>
      <form action="capturar.php" method="post">
        <label for="idusuario">ID Usuario:</label>
        <input type="text" id="idusuario" name="idusuario" required>

        <label for="foliopago">foliopago:</label>
        <input type="text" id="foliopago" name="foliopago" required>

        <label for="concepto">concepto:</label>
        <input type="text" id="concepto" name="concepto" required>

        <label for="mespagado">mespagado:</label>
        <input type="text" id="mespagado" name="mespagado" required>

        <label for="monto">monto:</label>
        <input type="number" id="monto" name="monto" required>

        <label for="fechapago">fechapago:</label>
        <input type="date" id="fechapago" name="fechapago" required>

        <button type="submit" name="submit_pago">Agregar Pago</button>
        </form></section></main><footer>
        <p>Colima, México 2024</p></footer></body>
</html>


