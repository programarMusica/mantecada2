<?php

// Obtener la acci�n seleccionada del formulario
$action = $_POST['action'];

// Redireccionar a la p�gina correspondiente seg�n la acci�n
switch ($action) {
    case 'consultar':
        header("Location: consultar.php");
        exit; // Salir del script despu�s de la redirecci�n
    case 'editar':
        header("Location: editar.php");
        exit; // Salir del script despu�s de la redirecci�n
    case 'capturar':
        header("Location: capturar.php");
        exit; // Salir del script despu�s de la redirecci�n
    case 'eliminar':
        header("Location: eliminar.php");
        exit; // Salir del script despu�s de la redirecci�n
    default:
        // Si la acci�n no es v�lida, mostrar un mensaje de error
        echo "Acci�n desconocida";
}

?>