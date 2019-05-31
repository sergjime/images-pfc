<?php
//////////////// BASE DE DATOS ////////////////
define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DBNAME','pfc_dual');

$usuario = $_POST['usu'];
$contrasenia = $_POST['contra'];

$pass_cifrado = password_hash($contrasenia, PASSWORD_DEFAULT);

try{
    $pdo = new PDO("mysql:host=".HOST."; dbname=" . DBNAME, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET CHARACTER SET UTF8");

    $sql = "INSERT INTO usuarios(nombre, avatar, nick, password_login, apellido1, apellido2, rol_usuario, fecha_alta, email) 
	VALUES (:nombre, :avatar, :nick, :contra, :ape1, :ape2, :rol, :fecha, :email)";

    $resultado = $pdo->prepare($sql);
    $resultado->execute(array(":nombre"=>'Ramón', ":avatar"=>'kjcfdks.jpg', ":nick"=>$usuario, ":contra"=>$pass_cifrado, ":ape1"=>'García', ":ape2"=>'Jiménez', ":rol"=>'user', ":fecha"=>'2019-05-30', ":email"=>'ramoncito@gmail.com'));

    echo 'Registro insertado';

    $resultado->closeCursor();

}catch(Exception $e){

    echo 'Línea del error: '. $e->getLine().'<br>'. $e->getMessage();

}finally{

    $base = null;
}
?>