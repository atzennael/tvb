<<<<<<< HEAD
<?php
$error_message = "";
// Conexión a la base de datos
if ($_POST) {
    session_start();
    require('conexion.php');
    // Manejar las diferentes operaciones según el valor del parámetro 'action'
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
            case 'read':
                $usuario = $_POST['usuario'];
                $sql = "SELECT * FROM usuario WHERE usuario = :usuario";
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':usuario', $_POST['usuario']);
                $stmt->execute();
                $num_rows = $stmt->rowCount();

                if ($num_rows > 0) {
                    // Si hay resultados, imprime los datos del usuario
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "Usuario: " . $row["usuario"] . "<br>";
                        echo "Contraseña: " . $row["contraseña"] . "<br>";
                        echo "Email: " . $row["email"] . "<br>";
                        echo "Teléfono: " . $row["telefono"] . "<br>";
                        echo "Identificación: " . $row["identificacion"] . "<br>";
                    }
                } else {
                    $error_message = "El usuario o contraseña son incorrectos. Intente nuevamente.";
                }
                break;

            case 'update':
                // Procesar la actualización de un registro en la base de datos
                $usuario = $_POST['usuario'];
                $pass = $_POST['pass'];
                $email = $_POST['email'];
                $telefono = $_POST['telefono'];
                $identificacion = $_POST['identificacion'];
                $sql = "UPDATE usuario SET pass = :pass, email = :email, telefono = :telefono, identificacion = :identificacion WHERE usuario = :usuario";
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':usuario', $usuario);
                $stmt->bindParam(':pass', $pass);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':telefono', $telefono);
                $stmt->bindParam(':identificacion', $identificacion);
                if ($stmt->execute()) {
                    echo "¡La información se actualizó correctamente!";
                } else {
                    echo "Error al actualizar la información.";
                }
                break;

            case 'delete':
                // Procesar la eliminación de un registro en la base de datos
                $usuario = $_POST['usuario'];
                $sql = "DELETE FROM usuario WHERE usuario = :usuario";
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':usuario', $usuario);
                if ($stmt->execute()) {
                    echo "¡La cuenta se eliminó correctamente!";
                } else {
                    echo "Error al eliminar la cuenta.";
                }
                break;

            default:
                echo "Operación no válida";
                break;
        }
    }

    // Cerrar la conexión
    $con = null;
}
=======
<?php
$error_message = "";
// Conexión a la base de datos
if ($_POST) {
    session_start();
    require('conexion.php');
    // Manejar las diferentes operaciones según el valor del parámetro 'action'
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
            case 'read':
                $usuario = $_POST['usuario'];
                $sql = "SELECT * FROM usuario WHERE usuario = :usuario";
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':usuario', $_POST['usuario']);
                $stmt->execute();
                $num_rows = $stmt->rowCount();

                if ($num_rows > 0) {
                    // Si hay resultados, imprime los datos del usuario
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "Usuario: " . $row["usuario"] . "<br>";
                        echo "Contraseña: " . $row["contraseña"] . "<br>";
                        echo "Email: " . $row["email"] . "<br>";
                        echo "Teléfono: " . $row["telefono"] . "<br>";
                        echo "Identificación: " . $row["identificacion"] . "<br>";
                    }
                } else {
                    $error_message = "El usuario o contraseña son incorrectos. Intente nuevamente.";
                }
                break;

            case 'update':
                // Procesar la actualización de un registro en la base de datos
                $usuario = $_POST['usuario'];
                $pass = $_POST['pass'];
                $email = $_POST['email'];
                $telefono = $_POST['telefono'];
                $identificacion = $_POST['identificacion'];
                $sql = "UPDATE usuario SET pass = :pass, email = :email, telefono = :telefono, identificacion = :identificacion WHERE usuario = :usuario";
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':usuario', $usuario);
                $stmt->bindParam(':pass', $pass);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':telefono', $telefono);
                $stmt->bindParam(':identificacion', $identificacion);
                if ($stmt->execute()) {
                    echo "¡La información se actualizó correctamente!";
                } else {
                    echo "Error al actualizar la información.";
                }
                break;

            case 'delete':
                // Procesar la eliminación de un registro en la base de datos
                $usuario = $_POST['usuario'];
                $sql = "DELETE FROM usuario WHERE usuario = :usuario";
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':usuario', $usuario);
                if ($stmt->execute()) {
                    echo "¡La cuenta se eliminó correctamente!";
                } else {
                    echo "Error al eliminar la cuenta.";
                }
                break;

            default:
                echo "Operación no válida";
                break;
        }
    }

    // Cerrar la conexión
    $con = null;
}
>>>>>>> 86680ea (Inicial commit de mi sitio web)
?>