<?php header('Access-Control-Allow-Origin: *'); ?>

<?php
include_once '../../api/usuarios/controller.php';
$api = new Controller();
$api ->UserGeneral()
?>