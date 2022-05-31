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
        $reclamo = new Model();
        $reclamos = array();
        $reclamos["items"] = array();
        $data = conexion::datosUsuarioToken();
        $res = [];
        if ($data) {
            $tipo = $data->tipo;
            if ($tipo == "administrador") {
                $res = $reclamo->obtenerPqrAdmin();
            } else {
                $res = $reclamo->obtenerPqr($data->id);
            }
        }

        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                if ($row['estado'] !== "Eliminado") {
                    $item = array(
                        'id_pqr' => $row['id_pqr'],
                        'tipo_pqr' => $row['tipo_pqr'],
                        'asunto' => $row['asunto'],
                        'usuario' => $row['id_usuario'],
                        'estado' => $row['estado'],
                        'fecha_creacion' => $row['fecha_creacion'],
                        'fecha_limite' => $row['fecha_limite'],
                        'nombre_usuario' => $row['nombre'],
                    );
                    array_push($reclamos['items'], $item);
                }
            }
            echo json_encode($reclamos);
        } else {
            echo json_encode(array('mensaje' => 'No hay elementos registrados'));
        }
    }

    function Add($tipo, $asunto, $usuario, $estado, $fecha_l)
    {
        $agregar = new Model();
        $agregar->agregarPqr($tipo, $asunto, $usuario, $estado, $fecha_l);
        echo json_encode(true);
    }

    function edit($tipo, $asunto, $usuario, $fecha_edit, $id, $usuario_session)
    {
        $editar = new Model();
        $editar->editarPqr($tipo, $asunto, $usuario, $fecha_edit, $id, $usuario_session);
        echo json_encode(true);
    }
    function delete($id, $estado, $fecha_eliminacion)
    {
        $eliminar = new Model();
        $eliminar->eliminarPqr($id, $estado, $fecha_eliminacion);
        echo json_encode(true);
    }
    function estado($id, $estado)
    {
        $NuevoEstado = "";
        $sw = false;
        if ($estado === "Nuevo") {
            $NuevoEstado = "En ejecucion";
            $sw = false;
        }
        if ($estado === "En ejecucion") {
            $NuevoEstado = "Cerrado";
            $sw = false;
        }
        if ($sw === false) {
            $CambiarEstado = new Model();
            $CambiarEstado->estadoPqr($id, $NuevoEstado);
            echo json_encode(true);
        }
    }
}
