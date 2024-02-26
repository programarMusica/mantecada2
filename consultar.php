<?php
// Conexión a la base de datos
require_once 'pdo.php';

session_start();

// Validar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: iniciarSesion.php");
    exit;
}

// Obtener el ID del usuario de la sesión
$usuario = $_SESSION["usuario"];


// Saludo para usuarios PDC
if (isset($usuario['tipousuario']) && $usuario['tipousuario'] === "PDC") {
	$nombre = isset($usuario['nombre']) ? $usuario['nombre'] : "";
	$apellidoPaterno = isset($usuario['apellidopaterno']) ? $usuario['apellidopaterno'] : "";
	$apellidoMaterno = isset($usuario['apellidomaterno']) ? $usuario['apellidomaterno'] : "";
	$tipoUsuario = isset($usuario['tipousuario']) ? $usuario['tipousuario'] : "";
	echo "<h2>Bienvenido $nombre $apellidoPaterno $apellidoMaterno</h2>";
}

// Consultar la base de datos para obtener los detalles del usuario
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE idusuario = ?");
$stmt->bindParam(1, $idusuario);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Saludo para usuarios PDC
if (isset($usuario['tipousuario']) && $usuario['tipousuario'] === "PDC") {
    $nombre = isset($usuario['nombre']) ? $usuario['nombre'] : "";
    $apellidopaterno = isset($usuario['apellidopaterno']) ? $usuario['apellidopaterno'] : "";
    $apellidomaterno = isset($usuario['apellidomaterno']) ? $usuario['apellidomaterno'] : "";
    echo "<h2>Bienvenido $nombre $apellidopaterno $apellidomaterno</h2>";
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consultar Usuarios</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Consultar Usuarios</h1>
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
      <p>¡Bienvenido <?php echo $nombre . " " . $apellidoPaterno . " " . $apellidoMaterno; ?>!</p>
            <p>¡Has ingresado como <?php echo $tipoUsuario; ?>!</p>
        </section>
    </section>
    <section class="contenido">
      <h2>Listado de Usuarios</h2>
      <table>
        <tr>
          <th>idusuario</th>
          <th>nombre</th>
          <th>apellidopaterno</th>
          <th>apellidomaterno</th>
          <th>edad</th>
          <th>sexo</th>
          <th>email</th>
          <th>tipousuario</th>
          <th>password</th>
          <!-- OJO REVISAR que no te falten conceptos de la tabla usuarios -->
        </tr>
        <?php
        // Consultar usuarios
        $stmt = $conn->query("SELECT * FROM usuarios");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          echo "<td>{$row['idusuario']}</td>";
          echo "<td>{$row['nombre']}</td>";
          echo "<td>{$row['apellidopaterno']}</td>";
          echo "<td>{$row['apellidomaterno']}</td>";
          echo "<td>{$row['edad']}</td>";
          echo "<td>{$row['sexo']}</td>";
          echo "<td>{$row['email']}</td>";
          echo "<td>{$row['tipousuario']}</td>";
          echo "<td>{$row['password']}</td>";
          
          echo "</tr>";
        }
        ?>
      </table>
    </section>

    <section class="contenido">
      <h2>Listado de Pagos</h2>
      <table>
        <tr>
          <th>foliopago</th>
          <th>idusuario</th>
          <th>concepto</th>
          <th>mespagado</th>
          <th>monto</th>
          <th>fechapago</th>
          <!-- OJO REVISA que no te falten conceptos de la tabla pagos -->
        </tr>
        <?php
        // Consultar pagos
        $stmt_pagos = $conn->query("SELECT * FROM pagos");
        while ($row_pagos = $stmt_pagos->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          echo "<td>{$row_pagos['foliopago']}</td>";
          echo "<td>{$row_pagos['idusuario']}</td>";
          echo "<td>{$row_pagos['concepto']}</td>";
          echo "<td>{$row_pagos['mespagado']}</td>";
          echo "<td>{$row_pagos['monto']}</td>";
          echo "<td>{$row_pagos['fechapago']}</td>";
          
          echo "</tr>";
        }
        ?>
      </table>
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
