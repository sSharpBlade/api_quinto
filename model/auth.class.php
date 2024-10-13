<?php
include_once '../connection/connect.php';

class Session
{
    public function login($postBody)
    {
        $dataArray = json_decode($postBody, true);
        if (!isset($dataArray['email']) || !isset($dataArray['password'])) {
            return ["error" => "Falta campo email o password"];
        } else {
            $user = $dataArray['email'];
            $pass = $dataArray['password'];
            $data = $this->getDataUser($user);
            if ($data) {
                if ($pass == $data[0]['Password']) {
                    if ($data[0]["Estado"] == "1") {
                        return ["success" => "ok"]; // Respuesta de éxito
                    } else {
                        return ["error" => "El email está inactivo"]; // Mensaje de error para email inactivo
                    }
                } else {
                    return ["error" => "La contraseña es incorrecta"]; // Mensaje de error para contraseña incorrecta
                }
            } else {
                return ["error" => "Usuario no encontrado"]; // Mensaje de error si el usuario no existe
            }
        }
    }

    private function getDataUser($mail)
    {
        $conn = new conexion();
        $con = $conn->conectar();
        $query = "SELECT UsuarioId, Password, Estado FROM usuarios WHERE Email = ?";
        $data = $con->prepare($query);
        $data->bind_param("s", $mail);
        $data->execute();
        $result = $data->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return null; // Cambiado a null para mejorar la lógica de verificación
    }
}
