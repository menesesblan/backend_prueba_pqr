<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
include_once '../../api/usuarios/controller.php';
$nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$email= (isset($_POST['email']))?$_POST['email']:"";
$tipo= (isset($_POST['tipo_u']))?$_POST['tipo_u']:"";
$password= MD5((isset($_POST['password']))?$_POST['password']:"");

$respuesta = [];
$sw = true;

if ($nombre == "") {
    $respuesta += ['nombre' => 'Ingrese un nombre'];
    $sw = false;
}

if ($email == "") {
    $respuesta += ['email' => 'Ingrese un email'];
    $sw = false;
}

if ($tipo == "") {
    $respuesta += ['tipo' => 'Ingrese un tipo'];
    $sw = false;
}

if ($password == "") {
    $respuesta += ['password' => 'Ingrese un password'];
    $sw = false;
}

// echo json_encode($respuesta);

$api = new Controller();
$api ->Add($nombre, $email, $tipo, $password);

// echo json_encode($api)
?>