<?php

// Obtener la acción seleccionada del formulario
$action = $_POST['action'];

// Redireccionar a la página correspondiente según la acción
switch ($action) {
    case 'consultar':
        header("Location: consultar.php");
        exit; // Salir del script después de la redirección
    case 'editar':
        header("Location: editar.php");
        exit; // Salir del script después de la redirección
    case 'capturar':
        header("Location: capturar.php");
        exit; // Salir del script después de la redirección
    case 'eliminar':
        header("Location: eliminar.php");
        exit; // Salir del script después de la redirección
    default:
        // Si la acción no es válida, mostrar un mensaje de error
        echo "Acción desconocida";
}

?>