<?php
include_once '../model/CRUD_estudiantes.php';

$opc = $_SERVER['REQUEST_METHOD'];

switch ($opc) {
    case 'GET':
        if (isset($_GET['estCedula'])) {
            $_acceder = estudiantes::obtenerEstudiante();
        } else {
            $_acceder = estudiantes::obtenerEstudiantes();
        }
        break;

    case 'POST':
        $_guardar = estudiantes::guardarEstudiante();
        break;

    case 'PUT':
        $_actualizar = estudiantes::modificarEstudiante();
        break;

    case 'DELETE':
        $_eliminar = estudiantes::eliminarEstudiante();
        break;

    default:
        break;
}
