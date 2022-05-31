<?php

include_once '../../global/conexion.php';

class Model extends CONEXION
{

    function obtenerPqrAdmin()
    {
        $query = $this->connect()->query("SELECT p.*,u.nombre FROM pqr as p INNER JOIN users as u ON u.id = p.id_usuario");
        return $query;
    }

    function obtenerPqr($id_usuario)
    {
        $query = $this->connect()->query("SELECT p.*,u.nombre FROM pqr as p INNER JOIN users as u ON u.id = p.id_usuario where p.id_usuario = '$id_usuario'");
        return $query;
    }

    function agregarPqr($tipo, $asunto, $usuario, $estado, $fecha_l)
    {
        $sentencia = $this->connect()->prepare("INSERT INTO pqr (tipo_pqr, asunto, id_usuario, estado, fecha_limite) 
        VALUES ('$tipo', '$asunto', '$usuario', '$estado', '$fecha_l')");
        $sentencia->execute();

        return $sentencia;
    }

    function editarPqr($tipo, $asunto, $usuario, $fecha_edit, $id, $usuario_session)
    {
        $edit = $this->connect()->prepare("UPDATE pqr SET `tipo_pqr`='$tipo',`asunto`='$asunto',`id_usuario`='$usuario',`fecha_edicion`='$fecha_edit',`usuario_edicion`='$usuario_session' WHERE id_pqr = '$id'");
        $edit->execute();

        return $edit;
    }
    function eliminarPqr($id, $estado, $fecha_eliminacion)
    {
        $delete = $this->connect()->prepare("UPDATE pqr SET `estado`='$estado', `fecha_eliminacion` = '$fecha_eliminacion'  WHERE id_pqr = '$id'");
        $delete->execute();

        return $delete;
    }

    function estadoPqr($id, $estado)
    {
        $delete = $this->connect()->prepare("UPDATE pqr SET `estado`='$estado' WHERE id_pqr = '$id'");
        $delete->execute();

        return $delete;
    }
}
