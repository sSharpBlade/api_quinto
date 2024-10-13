<?php
include_once '../model/CRUD_cursos.php';

$opc = $_SERVER['REQUEST_METHOD'];

switch ($opc) {
    case 'GET':
        if (isset($_GET['curId'])) {
            $_acceder = Cursos::obtenerCurso();
        } else {
            $_acceder = Cursos::obtenerCursos();
        }
        break;

    default:
        break;
}
