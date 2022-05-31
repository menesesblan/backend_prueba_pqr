<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
include_once '../../api/login/controller.php';
$email= (isset($_POST['email']))?$_POST['email']:"";
$password= MD5((isset($_POST['password']))?$_POST['password']:"");

$respuesta = [];
$sw = true;

if ($email == "") {
    $respuesta += ['email' => 'Ingrese un email'];
    $sw = false;
}

if ($password == "") {
    $respuesta += ['password' => 'Ingrese un password'];
    $sw = false;
}

// echo json_encode($respuesta);

$api = new Controller();
$api ->login($email, $password);

// echo json_encode($api)
?>