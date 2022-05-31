<?php

require_once  '../../vendor/autoload.php';

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Conexion
{

   function connect()
   {
      $host = 'localhost';
      $dbname = 'proyecto_pqr';
      $usuario = 'root';
      $password = '';

      try {
         $conn = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $password);
         // echo "<script>alert ('Conectado...')</script>";
      } catch (PDOException $exp) {
         // echo "<script>alert ('No se logro conectar... $exp')</script>";
      }
      return $conn;
   }

   // General token

   static function jwt($id, $email, $tipo)
   {
      $time = time();
      $token = array(
         "iat" => $time,
         "exp" => $time + (60 * 60 * 24), //Un dia
         "data" => [
            "id" => $id,
            "email" => $email,
            "tipo" => $tipo,
         ]
      );

      $jwt = JWT::encode($token, "jshdajshjdskajsd", "HS256");
      return $jwt;
   }

   static function validarToken()
   {
      $isAuth = false;
      $headers = apache_request_headers();
      if (isset($headers['Authorization'])) {
         $token = $headers['Authorization'];
         $decoded = JWT::decode($token, new Key("jshdajshjdskajsd", 'HS256'));
         if ($decoded) {
            $time = time();
            $exp = $decoded->exp;
            if ($exp > $time)  $isAuth = true;
         }
      }
      return $isAuth;
   }

   static function datosUsuarioToken()
   {
      $data = null;
      $headers = apache_request_headers();
      if (isset($headers['Authorization'])) {
         $token = $headers['Authorization'];
         $decoded = JWT::decode($token, new Key("jshdajshjdskajsd", 'HS256'));
         if ($decoded) {
            $data = $decoded->data;
         }
      }
      return $data;
   }
}
