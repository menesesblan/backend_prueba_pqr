<?php
include_once '../../global/conexion.php';
class Model extends CONEXION
{

    function obtener($email, $password)
    {
        $query = $this->connect()->query("SELECT * FROM users where correo ='$email' AND `password`='$password'");
        return $query;
    }
}
