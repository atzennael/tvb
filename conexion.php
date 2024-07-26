<?php
$servername="localhost";
$username="root";
$password="";
$database="tvb_bdd";

	try {
		$con = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

		$con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Conexión exitosa a la Base de Datos";
	} catch(PDOException $e){
		echo "Conexión fallida:  " . $e->getMessage();
	}
	?>