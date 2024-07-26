<?php
error_reporting(E_ERROR | E_PARSE);
	//datos de conexion
		$servername="localhost";
		$username="root";
		$password="";
		$database="tvb_bdd";

	//obtener datos del formulario
		$usuario = $_POST['usuario'];
		$pass = $_POST['pass'];
		$email = $_POST['email'];
		$telefono = $_POST['telefono'];
		$identificacion = $_POST['identificacion'];

	//crear conexion
		$con = new mysqli($servername, $username, $password, $database);

	//verificar conexion
		if ($con->connect_error){
			die("Conexión fallida:  " . $con->connect_error);
		}

	//sentencia sql para la inserción

		$sql = "insert into usuario (usuario, contraseña, email, telefono, identificacion) values ('$usuario', '$pass', '$email', '$telefono', '$identificacion')";

		if ($con->query($sql) === TRUE){
			echo "Usuario ingresado exitosamente";
		} else {
			"Error al ingresar usuario:  " . $con->error;
		}

		//cerrar conexion
		$con->close();
?>