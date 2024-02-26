<?php
// Conexión a la base de datos
require_once 'pdo.php';

// Función para iniciar sesión
function iniciar_sesion($idusuario, $password, $conn) {
    // Consulta SQL para obtener el usuario
    $sql = "SELECT * FROM usuarios WHERE idusuario = :idusuario AND password = :password AND tipousuario IN ('PF', 'PDC');";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);

    // Bindear los parámetros
    $stmt->bindParam(":idusuario", $idusuario, PDO::PARAM_STR);
    $stmt->bindParam(":password", $password, PDO::PARAM_STR);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si se encontró un usuario
    if ($usuario) {
        // Iniciar sesión
        session_start();
        $_SESSION["usuario"] = $usuario;

        // Redireccionar según el tipo de usuario
        switch ($usuario["tipousuario"]) {
            case "PF":
                header("Location: UserPF.php");
                exit;
            case "PDC":
                header("Location: UserPDC.php");
                exit;
            default:
                // Usuario no reconocido
                echo "<p>Error: Tipo de usuario no reconocido.</p>";
                exit;
        }
    } else {
        // Mostrar un mensaje de error y redireccionar a iniciarSesion.php
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href = 'iniciarSesion.php';</script>";
        exit;
    }
}

// Si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario
    $idusuario = $_POST["idusuario"];
    $password = $_POST["password"];

    // Iniciar sesión
    iniciar_sesion($idusuario, $password, $conn);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Colegio México - Iniciar sesión</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
  <h1>Colegio México</h1>
</header>
<main>
  <section class="formulario">
    <h2>Iniciar sesión</h2>
    <form action="iniciarSesion.php" method="post">
      <label for="idusuario">ID Usuario:</label>
      <input type="text" id="idusuario" name="idusuario" required>
      <br>
      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required>
      <br>
      <br>
      <button type="submit">Iniciar sesión</button>
    </form>
  </section>
</main>
<footer>
  <p>Colima, México 2024</p>
</footer>
</body>
</html>
