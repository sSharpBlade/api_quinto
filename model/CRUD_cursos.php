<?php
include_once '../connection/connect.php';

class Cursos
{
    static function obtenerCursos()
    {
        $conn = new conexion();
        $con = $conn->conectar();
        $sqlCursos = "select curId, Nombre from cursos";
        $respuesta = $con->query($sqlCursos);
        $cursos = array();
        if ($respuesta->num_rows > 0) {
            while ($fila = $respuesta->fetch_assoc()) {
                array_push($cursos, $fila);
            }
        } else {
            $cursos = array();
        }

        echo json_encode($cursos);
        $con->close();
    }

    static function obtenerCurso()
    {
        $conn = new conexion();
        $con = $conn->conectar();
        $curId = $_GET['curId'];
        $sqlCurso = "select curId, Nombre from cursos WHERE curId='$curId'";
        $respuesta = $con->query($sqlCurso);
        $curso = array();
        if ($respuesta->num_rows > 0) {
            while ($fila = $respuesta->fetch_assoc()) {
                array_push($curso, $fila);
            }
        } else {
            $curso = array();
        }

        echo json_encode($curso);
        $con->close();
    }
}
