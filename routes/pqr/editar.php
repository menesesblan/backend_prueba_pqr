<?php header('Access-Control-Allow-Origin: *'); ?>

<?php
include_once '../../api/pqr/controller.php';

$id = (isset($_POST['id'])) ? $_POST['id'] : "";
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : "";
$asunto = (isset($_POST['asunto'])) ? $_POST['asunto'] : "";
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : "";
$fecha_edit = date("Y-m-d");
$usuario_session = "andrea";

$respuesta = [];
$sw = true;

if ($id == "") {
    $respuesta += ['id' => 'Ingrese un id'];
    $sw = false;
}
if ($tipo == "") {
    $respuesta += ['tipo' => 'Ingrese un tipo'];
    $sw = false;
}
if ($asunto == "") {
    $respuesta += ['asunto' => 'Ingrese el asunto'];
    $sw = false;
}
if ($usuario == "") {
    $respuesta += ['usuario' => 'Ingrese un usuario'];
    $sw = false;
}

if ($usuario_session == "") {
    $respuesta += ['session' => 'vacio'];
    $sw = false;
}

// json_encode($respuesta);

$api = new Controller();
$api->edit($tipo, $asunto, $usuario, $fecha_edit, $id, $usuario_session);
// echo json_encode($api);
?>