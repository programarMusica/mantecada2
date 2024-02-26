<?php
// Conexión a la base de datos

require_once 'pdo.php';


session_start();

// Validar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: iniciarSesion.php");
    exit;
}



// Verificar si se ha enviado el formulario de eliminación de usuario
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["idusuario"])) {
    $idusuario = $_POST["idusuario"];

    // Preparar la consulta SQL para eliminar el usuario
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE idusuario = ?");
    $stmt->execute([$idusuario]);

    // También eliminamos los pagos asociados a ese usuario (si es necesario) PARA TABLA PAGOS
    $stmt = $conn->prepare("DELETE FROM pagos WHERE idusuario = ?");
    $stmt->execute([$idusuario]);

    // Redirigir a la página de consulta
    header("Location: consultar.php");
    exit;
}

// Obtener el ID del usuario a eliminar
if (isset($_GET["idusuario"])) {
    $idusuario = $_GET["idusuario"];

    // Consultar los datos del usuario a eliminar
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE idusuario = ?");
    $stmt->execute([$idusuario]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Si no se proporcionó un ID de usuario, redirigir a la página de consulta
    header("Location: consultar.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Eliminar Usuario</h1>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="consultar.php">Consultar</a>
        <a href="capturar.php">Capturar</a>
        <a href="editar.php">Editar</a>
        <a href="eliminar.php">Eliminar</a>
        <a href="salir.php">Salir</a>
    </nav>
</header>
<main>
    <section class="informacion-usuario">
        <h2>Bienvenido</h2>
        <?php
        echo "<p>¡Bienvenido {$_SESSION["usuario"]->nombre} {$_SESSION["usuario"]->apellidopaterno} {$_SESSION["usuario"]->apellidomaterno}!</p>";
        echo "<p>¡Has ingresado como {$_SESSION["usuario"]->tipousuario}!</p>";
        ?>
    </section>
    <section class="contenido">
        <h2>Eliminar Usuario</h2>
        <p>¿Estás seguro de que deseas eliminar el siguiente usuario?</p>
        <p>idusuario: <?php echo $idusuario; ?></p>


        <p>idusuario: <?php echo $usuario['idusuario']; ?></p>
        <p>nombre: <?php echo $usuario['nombre']; ?></p>
        <p>apellidopaterno: <?php echo $usuario['apellidopaterno']; ?></p>
        <p>apellidomaterno: <?php echo $usuario['apellidomaterno']; ?></p> 


        <form method="post" action="eliminar.php">
            <input type="hidden" name="idusuario" value="<?php echo $usuario['idusuario']; ?>">
            <input type="submit" value="Eliminar">
        </form>
    </section>
</main>
<footer>
    <p>Colima, México 2024</p>
</footer>
</body>
</html>

<?php
// Cerrar conexión a la base de datos
$conn = null;
?>