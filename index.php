
<?php
// Conexión a la base de datos
require_once 'pdo.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colegio México</title> 

    <link rel="stylesheet" href="styles.css">
    

</head>
<body>
    <header>
        <h1>Colegio México</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="registro.php">Registro</a>
            <a href="iniciarSesion.php">Iniciar sesión</a>
        </nav>
    </header>
    <main>
        <section class="informacion">
            <h2>Bienvenido</h2>
            <p>¡Bienvenido al Colegio México! Aquí podrás encontrar información útil para padres de familia y comunidad escolar.</p>  
        </section>
        <section class="imagen">
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?crop=entropy&cs=srgb&fm=jpg&ixid=M3wzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDg0MTAzNzB8&ixlib=rb-4.0.3&q=85" 
            alt="Imagen del Colegio México">
        </section>
    </main>
    <footer>
        <p>Colima, México 2024</p>
    </footer>
</body>
</html>
