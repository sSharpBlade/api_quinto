<?php

require_once "../model/auth.class.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $_login = new Session();
    $response = $_login->login(file_get_contents("php://input"));
    echo json_encode($response);
}
