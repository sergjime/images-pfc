<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>


<?php
//////////////// BASE DE DATOS ////////////////
define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DBNAME','pfc_dual');
try{
	
	$login=htmlentities(addslashes($_POST["login"]));
	
	$password=htmlentities(addslashes($_POST["password"]));
	$contador = 0;
	
    $pdo = new PDO("mysql:host=".HOST."; dbname=" . DBNAME, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET CHARACTER SET UTF8");
	
	
	$sql="SELECT * FROM usuarios WHERE nick= :login";
	
	$resultado=$pdo->prepare($sql);	
		
	$resultado->execute(array(":login"=>$login));
		
		while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){			
					
			if (password_verify($password, $registro['password_login'])){
                $contador++;
            }	
			
		}
		
			if ($contador > 0){
                echo 'ENHORABUENA!!!, Iniciaste sesión<br> Nombre de usuario: <strong>'.$login.'</strang><br> Contraseña: <strong>'.$password.'</strong>';
            }else{
                echo 'Usuario NO registrado';
            }
		
		
		$resultado->closeCursor();

	
	
}catch(Exception $e){
	
	die("Error: " . $e->getMessage());
	
	
	
}




?>
</body>
</html>