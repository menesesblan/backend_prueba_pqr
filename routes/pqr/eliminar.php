<?php header('Access-Control-Allow-Origin: *'); ?>

<?php
include_once '../../api/pqr/controller.php';

$id = (isset($_POST['id'])) ? $_POST['id'] : "";
$estado="Eliminado";
$fecha_eliminacion= time();
$respuesta = [];
$sw = true;

if ($id == "") {
    $respuesta += ['id' => 'Ingrese un Id'];
    $sw = false;
}


$api = new Controller();
$api->delete($id, $estado, $fecha_eliminacion);

?>