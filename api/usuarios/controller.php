<?php

include_once 'model.php';
include_once '../../global/conexion.php';

class Controller
{
    public function __construct()
    {
        $token = conexion::validarToken();
        if (!$token) {
            header("HTTP/1.1 401 Unauthorized");
            exit;
        }
    }

    function getAll()
    {
        $usuario = new Model();
        $usuarios = array();
        $usuarios["items"] = array();

        $res = $usuario->obtenerUsuarios();

        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre'],
                    'correo' => $row['correo'],
                    'tipo' => $row['tipo'],
                    'password' => $row['password']
                );
                array_push($usuarios['items'], $item);
            }
            echo json_encode($usuarios);
        } else {
            echo json_encode(array('mensaje' => 'No hay elementos registrados'));
        }
    }

    function UserGeneral()
    {
        $usuario = new Model();
        $usuarios = array();

        $res = $usuario->obtenerUsuariosGeneral();

        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre'],
                );
                array_push($usuarios, $item);
            }
            echo json_encode($usuarios);
        } else {
            echo json_encode(array('mensaje' => 'No hay elementos registrados'));
        }
    }

    function Add($nombre, $email, $tipo, $password)
    {
        $agregar = new Model();
        $sw = false;
        $validate = $agregar->obtenerUsuarios();
        if ($validate->rowCount()) {
            while ($row = $validate->fetch(PDO::FETCH_ASSOC)) {
                if ($row['correo'] == $email) {
                    $mensaje = array();
                    $mensaje["items"] = array();
                    array_push($mensaje['items'], "Email ya registrado");
                    echo json_encode($mensaje);
                    $sw = true;
                }
            }
        }
        if ($sw === false) {
            $agregar = new Model();
            $res = $agregar->agregarU($nombre, $email, $tipo, $password);

            echo json_encode($res);
        }
    }
}
