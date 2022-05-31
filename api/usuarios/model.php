<?php

include_once '../../global/conexion.php';

class Model extends CONEXION{
    
    function obtenerUsuarios() {
        $query= $this->connect()->query('SELECT * FROM users');
        return $query;
    }

    function obtenerUsuariosGeneral() {
        $query= $this->connect()->query('SELECT nombre, id FROM users WHERE tipo="General"');
        return $query;
    }

    function agregarU( $nombre, $email, $tipo, $password ) {
       
        // $validation_email= $this->connect()->query("SELECT correo FROM `users` WHERE correo='jose@gmail.com'");
        $sentencia= $this->connect()->prepare("INSERT INTO `users` (`nombre`, `correo`, `tipo`, `password`) 
        VALUES ('$nombre', '$email', '$tipo', '$password' )");
        $sentencia->execute();

        return $sentencia;
    }
}

?>