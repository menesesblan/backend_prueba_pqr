<?php header('Access-Control-Allow-Origin: *'); ?>

<?php
include_once '../../api/pqr/controller.php';
$api = new Controller();
$api ->getAll()
?>