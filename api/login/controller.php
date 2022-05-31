<?php

include_once 'model.php';
include_once '../../global/conexion.php';

class Controller
{
    function login($email, $password)
    {
        $login = new Model();
        $res = $login->obtener($email, $password)->fetch(PDO::FETCH_ASSOC);
        if ($res) {
            $token = conexion::jwt($res['id'], $res['correo'], $res['tipo']);
            echo json_encode((object) ["estado" => true, "token" => $token, "id_usuario" => $res['id'], "tipo" => $res['tipo']]);
            return true;
        }
        echo json_encode((object) ["estado" => false]);
    }
}
