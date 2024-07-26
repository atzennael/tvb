<?php
		$servername="localhost";
		$username="root";
		$password="";
		$database="tvb_bdd";	
//crear conexion
$con = new mysqli($servername, $username, $password, $database);

//Verificar conexion
if ($con->connect_error){
    die("Conexión fallida: " . $con->connect_error);
}
//Sentencia SQL para la Consulta
$sql = "SELECT usuario, email, telefono FROM usuario";
$result = $con->query($sql);
if ($result->num_rows > 0){
    //Mostrar datos de cada fila
    while($row = $result->fetch_assoc()){
        echo "- Usuario: " . $row["usuario"] . " - Email: " . $row["email"] . " - Telefono: " . $row["telefono"] . "<br>";
    }
} else {
    echo "No se encontraron resultados";
}
//Cerrar conexión
$con->close();
?>
