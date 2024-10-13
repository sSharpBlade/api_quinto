<?php
include_once '../connection/connect.php';
class estudiantes
{
    static function obtenerEstudiantes()
    {
        $conn = new conexion();
        $con = $conn->conectar();

        $sqlSelect = "select
        estudiantes.estCedula,
        estudiantes.estNombre,
        estudiantes.estApellido,
        estudiantes.estTelefono,
        estudiantes.estDireccion,
        cursos.Nombre, cursos.curId from estudiantes
        JOIN cursos ON estudiantes.curId = cursos.curId";
        $respuesta = $con->query($sqlSelect);
        $resultado = array();
        if ($respuesta->num_rows > 0) {
            while ($fila = $respuesta->fetch_array()) {
                array_push($resultado, $fila);
            }
        } else {
            $resultado = "No hay estudiantes";
        }
        echo json_encode($resultado);
        $con->close();
    }

    static function obtenerEstudiante()
    {
        $conn = new conexion();
        $con = $conn->conectar();

        $estCedula = $_GET['estCedula'];

        $sqlSeleccionar = "select
        estudiantes.estCedula,
        estudiantes.estNombre,
        estudiantes.estApellido,
        estudiantes.estTelefono,
        estudiantes.estDireccion,
        cursos.curId from estudiantes
        JOIN cursos ON estudiantes.curId = cursos.curId WHERE estCedula='$estCedula'";
        $respuesta = $con->query($sqlSeleccionar);
        $resultado = array();
        if ($respuesta->num_rows > 0) {
            while ($fila = $respuesta->fetch_array()) {
                array_push($resultado, $fila);
            }
        } else {
            $resultado = "No existe el estudiante";
        }
        echo json_encode($resultado);
        $con->close();
    }

    static function eliminarEstudiante()
    {
        $conn = new Conexion();
        $con = $conn->conectar();

        $data = json_decode(file_get_contents("php://input"), true);
        $cedula = $data['cedula'];

        $sqlBorrar = "DELETE FROM estudiantes WHERE estCedula='$cedula'";

        if ($con->query($sqlBorrar) === TRUE) {
            echo json_encode(["success" => true, "message" => "Se borró el estudiante"]);
        } else {
            echo json_encode(["success" => false, "message" => "Fallo: " . $con->error]);
        }
        $con->close();
    }


    static function modificarEstudiante()
    {
        $conn = new Conexion();
        $con = $conn->conectar();
        $data = json_decode(file_get_contents("php://input"), true);
        $cedula = $data['cedula'];
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $direcion = $data['direccion'];
        $telefono = $data['telefono'];
        $curId = $data['curId'];
        $sqlEditar = "update estudiantes set estNombre='$nombre', estApellido='$apellido', estDireccion='$direcion', estTelefono='$telefono', curId='$curId' where estCedula='$cedula'";
        if ($con->query($sqlEditar) == TRUE) {
            echo  json_encode("Se edito");
        } else {
            echo json_encode("Fallo" . $sqlEditar);
        }
        $con->close();
    }

    static function guardarEstudiante()
    {
        $conn = new Conexion();
        $con = $conn->conectar();
        $data = json_decode(file_get_contents("php://input"), true);
        $cedula = $data['cedula'];
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $telefono = $data['telefono'];
        $direccion = $data['direccion'];
        $curId = $data['curId'];

        $sqlInsert = "insert into estudiantes values('$cedula','$nombre','$apellido','$telefono','$direccion','$curId')";
        if ($con->query($sqlInsert) == TRUE) {
            echo  json_encode("Se guardo");
        } else {
            echo json_encode("Fallo" . $sqlInsert);
        }
        $con->close();
    }
}
