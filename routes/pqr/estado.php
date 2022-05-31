<?php header('Access-Control-Allow-Origin: *'); ?>

<?php
include_once '../../api/pqr/controller.php';

$id = (isset($_POST['id'])) ? $_POST['id'] : "";
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : "";

$respuesta = [];
$sw = true;

if ($id == "") {
    $respuesta += ['id' => 'Ingrese un Id'];
    $sw = false;
}



$api = new Controller();
$api->estado($id, $estado);

?>