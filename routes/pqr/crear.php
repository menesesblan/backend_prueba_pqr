<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
include_once '../../api/pqr/controller.php';

$tipo = (isset($_POST['tipo_pqr'])) ? $_POST['tipo_pqr'] : "";
$asunto = (isset($_POST['asunto'])) ? $_POST['asunto'] : "";
$usuario = (isset($_POST['nombre'])) ? $_POST['nombre'] : "";
$estado = "Nuevo";
$fecha = date("Y-m-d");
$tipo === "Peticion" ? $fecha_l = date("Y-m-d", strtotime($fecha . "+ 7 day")) : $tipo === "Queja" ? $fecha_l = date("Y-m-d", strtotime($fecha . "+ 3 day")) : $fecha_l = date("Y-m-d", strtotime($fecha . "+ 2 day"));

$respuesta = [];
$sw = true;

if ($tipo == "") {
    $respuesta += ['tipo_pqr' => 'Ingrese un tipo'];
    $sw = false;
}

if ($asunto == "") {
    $respuesta += ['tipo_pqr' => 'Ingrese un asunto'];
    $sw = false;
}

// echo json_encode($respuesta);

$api = new Controller();
$api->Add($tipo, $asunto, $usuario, $estado, $fecha_l);

// echo json_encode($api)
?>