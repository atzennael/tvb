<<<<<<< HEAD
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

	$sql = "insert into usuario (usuario, pass, email, telefono, identificacion) values ('$usuario', '$pass', '$email', '$telefono', '$identificacion')";

		if ($con->query($sql) === TRUE){
			$exito="Usuario ingresado exitosamente";
			?>
			<script>
			if ("<?php echo $exito; ?>" != "") {
			 confirm("<?php echo $exito; ?>");
			 window.location.href = "http://localhost/web/ParcialII/iniciosesion.html";
			}
</script>
<?php
		} elseif (isset($error) && $error != "") {
  echo "<script>confirm('$error'); window.location.replace('http://localhost/web/ParcialII/registrousuario.html');</script>";
}

		//cerrar conexion
		$con->close();
=======
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

	$sql = "insert into usuario (usuario, pass, email, telefono, identificacion) values ('$usuario', '$pass', '$email', '$telefono', '$identificacion')";

		if ($con->query($sql) === TRUE){
			$exito="Usuario ingresado exitosamente";
			?>
			<script>
			if ("<?php echo $exito; ?>" != "") {
			 confirm("<?php echo $exito; ?>");
			 window.location.href = "http://localhost/web/ParcialII/iniciosesion.html";
			}
</script>
<?php
		} elseif (isset($error) && $error != "") {
  echo "<script>confirm('$error'); window.location.replace('http://localhost/web/ParcialII/registrousuario.html');</script>";
}

		//cerrar conexion
		$con->close();
>>>>>>> 86680ea (Inicial commit de mi sitio web)
?>