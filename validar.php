<?php 
$error_message="";
if ($_POST){
  session_start();
  require('conexion.php');
  $usuario = $_POST['usuario'];
  $pass = $_POST['pass'];
  $con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query = $con->prepare("SELECT * FROM usuario where usuario = :usuario and pass=:pass");
  $query->bindParam(":usuario", $usuario);
  $query->bindParam(":pass", $pass);
  $query->execute();
  $usuario = $query->fetch(PDO::FETCH_ASSOC);
  if ($usuario){
    $_SESSION["usuario"]=$usuario["usuario"];
    header("location:http://localhost/web/ParcialII/paginaIniciada.html");
    exit();
  } else {
    $error_message="El usuario o contraseña son incorrectos. Intente nuevamente.";
  }
}
 ?>
<script>
if ("<?php echo $error_message; ?>" != "") {
  confirm("<?php echo $error_message; ?>");
  window.location.href = "http://localhost/web/ParcialII/iniciosesion.html";
}
</script>

