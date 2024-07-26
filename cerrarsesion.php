<<<<<<< HEAD

<?php
session_start();

$_SESSION = array();

session_destroy();
$message="La sesión se cerró correctamente";
header("Location: http://localhost/web/ParcialII/pagina.html");

exit();
?>

=======

<?php
session_start();

$_SESSION = array();

session_destroy();
$message="La sesión se cerró correctamente";
header("Location: http://localhost/web/ParcialII/pagina.html");

exit();
?>

>>>>>>> 86680ea (Inicial commit de mi sitio web)
