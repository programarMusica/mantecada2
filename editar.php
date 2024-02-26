<?php
require_once 'pdo.php';
session_start();

// Validar sesión de usuario
if (!isset($_SESSION["usuario"])) {
    header("Location: iniciarSesion.php");
    exit;
}

// Procesar formulario de edición de usuario
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["idusuario"])) {
    $idusuario = $_POST["idusuario"];
    $campos = ['nombre', 'apellidopaterno', 'apellidomaterno', 'edad', 'sexo', 'email', 'tipousuario', 'password'];
    $valores = array_intersect_key($_POST, array_flip($campos));

    // Actualizar datos del usuario
    $sql = "UPDATE usuarios SET ";
    foreach ($valores as $campo => $valor) {
        $sql .= "$campo = :$campo, ";
    }
    $sql = rtrim($sql, ", ");
    $sql .= " WHERE idusuario = :idusuario";
    
    $stmt = $conn->prepare($sql);
    $valores['idusuario'] = $idusuario;
    $stmt->execute($valores);

    // Redireccionar a la página de consulta
    header("Location: consultar.php");
    exit;
}

// Procesar formulario de edición de pago
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["foliopago"])) {
    $foliopago = $_POST["foliopago"];
    $camposPago = ['idusuario', 'concepto', 'mespagado', 'monto', 'fechapago'];
    $valoresPago = array_intersect_key($_POST, array_flip($camposPago));

    // Actualizar datos del pago
    $sqlPago = "UPDATE pagos SET ";
    foreach ($valoresPago as $campo => $valor) {
        $sqlPago .= "$campo = :$campo, ";
    }
    $sqlPago = rtrim($sqlPago, ", ");
    $sqlPago .= " WHERE foliopago = :foliopago";

    $stmtPago = $conn->prepare($sqlPago);
    $valoresPago['foliopago'] = $foliopago;
    $stmtPago->execute($valoresPago);

    // Redireccionar a la página de consulta
    header("Location: consultar.php");
    exit;
}

// Obtener datos del usuario a editar
$usuario = null;
if (isset($_GET["idusuario"])) {
    $idusuario = $_GET["idusuario"];
    $stmtUsuario = $conn->prepare("SELECT * FROM usuarios WHERE idusuario = ?");
    $stmtUsuario->execute([$idusuario]);
    $usuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);
}

// Obtener datos del pago a editar
$pago = null;
if (isset($_GET["foliopago"])) {
    $foliopago = $_GET["foliopago"];
    $stmtPago = $conn->prepare("SELECT * FROM pagos WHERE foliopago = ?");
    $stmtPago->execute([$foliopago]);
    $pago = $stmtPago->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario y Pago</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Editar Usuario y Pago</h1>
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
        <?php if ($usuario): ?>
            <p>¡Bienvenido <?php echo $usuario['nombre'] . ' ' . $usuario['apellidopaterno'] . ' ' . $usuario['apellidomaterno']; ?>!</p>
            <p>¡Has ingresado como <?php echo $usuario['tipousuario']; ?>!</p>
        <?php endif; ?>
    </section>
    <section class="contenido">
        <h2>Editar Usuario</h2>
        <?php if ($usuario): ?>
            <form method="post" action="editar.php">
                <input type="hidden" name="idusuario" value="<?php echo $usuario['idusuario']; ?>">
                <!-- Agrega aquí los campos para editar el usuario -->
                <input type="submit" value="Guardar Cambios">
            </form>
        <?php endif; ?>
    </section>
    <section class="contenido">
        <h2>Editar Pago</h2>
        <?php if ($pago): ?>
            <form method="post" action="editar.php">
                <input type="hidden" name="foliopago" value="<?php echo $pago['foliopago']; ?>">
                <!-- Agrega aquí los campos para editar el pago -->
                <input type="submit" value="Guardar Cambios">
            </form>
        <?php endif; ?>
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
