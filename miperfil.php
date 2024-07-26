<?php
// Establecer conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "tvb_bdd";

// Iniciar o reanudar la sesión
session_start();

// Verificar si el usuario está autenticado y si la sesión 'usuario' está definida
if (!isset($_SESSION['usuario'])) {
    // Si el usuario no está autenticado o la sesión 'usuario' no está definida, redirigirlo a la página de inicio de sesión
    header("Location: inicio_sesion.php");
    exit(); // Asegura que el script se detenga después de redirigir
}

$usuario = $_SESSION['usuario'];

try {
    $con = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}

// Definir una variable para almacenar los datos del resultado de la búsqueda
$resultado = null;

// Procesar formulario de búsqueda
if(isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
    $query = $con->prepare("SELECT * FROM usuario WHERE usuario = :usuario");
    $query->bindParam(":usuario", $usuario);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);
}

if(isset($_POST['actualizar'])) {
   $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $query = $con->prepare("UPDATE usuario SET pass = :pass, email = :email, telefono = :telefono WHERE usuario = :usuario");
    $query->bindParam(":pass", $pass);
    $query->bindParam(":email", $email);
    $query->bindParam(":telefono", $telefono);
    $query->bindParam(":usuario", $usuario);
    $query->execute();

    $message="Los datos se actualizaron correctamente";
}

if(isset($_POST['eliminar'])) {
   $usuario = $_POST['usuario'];


    $query = $con->prepare("DELETE FROM usuario WHERE usuario = :usuario");
    $query->bindParam(":usuario", $usuario);
    $query->execute();

    $message="El usuario fue eliminado.";
}

?>
<script>
if ("<?php echo $message; ?>" != "") {
  confirm("<?php echo $message; ?>");
  window.location.href = "http://localhost/web/ParcialII/miperfil.php";
}
</script>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TVB - Mi Perfil</title>
  <style>
      body {
          font-family: Arial, sans-serif;
          background-color: #f4f4f4;
          overflow-x: hidden;
          overflow-y: auto;
      }
    nav {
      background-color: #AA7EEE;
      padding: 10px 0;
    }
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
    }
    li {
      float: right;
    }
    li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }
    li a:hover {
      background-color: #6333AE;
    }
    h1 {
      text-align: center;
    }
    .logo-img {
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
     h2 {
	text-align: center;
     }

body {
  margin: 0;
  padding: 0;
}
      .footer-nav {
          position: fixed;
          bottom: 0;
          width: 100%;
          background-color: #AA7EEE;
          margin-top: 20px;
      }

.footer-nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  text-align: center;
}
.footer-nav li {
  display: inline;
}

.footer-nav li a {
  display: inline-block;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
}

.footer-nav li a:hover {
  background-color: #6333AE;
}
      button {
          background-color: #AA7EEE;
          color: white;
          padding: 10px 20px;
          border: none;
          border-radius: none;
          outline: none;
          cursor: pointer;
          font-size: 16px;
          text-decoration: none;
      }

          button:hover {
              background-color: #6333AE;
              text-decoration: none;
              color: white;
          }

      a {
          text-decoration: none;
          color: white;
          border: none;
          outline: none;
          cursor: pointer;
      }
      .center {
          text-align: center;
      }
      .center img {
          display: block;
          margin: auto;
      }
      .fixed-top {
          position: fixed;
          top: 0;
          width: 100%;
          z-index: 100;
          height: 40px;
      }
      .content {
          padding-top: 70px;
      }
      .wrapper {
      margin-top: 5%;
      width: 60%;
      display: flex;
      justify-content: center;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      -webkit-box-shadow: 9px 13px 25px 0px rgba(0, 0, 0, 0.18);
      -moz-box-shadow: 9px 13px 25px 0px rgba(0, 0, 0, 0.18);
      box-shadow: 9px 13px 25px 0px rgba(0, 0, 0, 0.18);
        }
      .form-group {
      display: flex; 
      margin-bottom: 10px; 
            }
            .form-group {
              display: flex; /* Makes label and input display side-by-side */
              margin-bottom: 10px; /* Optional spacing between groups */
            }

            .form-group label {
              width: 120px; /* Adjust width as needed for label text */
              text-align: right; /* Justify labels to the right */
            }

            .form-group input[type="text"],
            .form-group input[type="email"],
            .form-group input[type="password"] {
              width: 100%; /* Set the same width for all input types */
              padding: 5px; /* Adjust padding as needed */
              border: 1px solid #ccc; /* Optional border style */
            }
                .margen {
            margin-top: 100px;
            margin-left: 300px;
            margin-bottom: 100px;
        }
      .button {
          background-color: #AA7EEE;
          color: white;
          padding: 10px 20px;
          border: none;
          border-radius: none;
          outline: none;
          cursor: pointer;
          font-size: 16px;
          text-decoration: none;
      }

          .button:hover {
              background-color: #6333AE;
              text-decoration: none;
              color: white;
          }

      a {
          text-decoration: none;
          color: white;
          border: none;
          outline: none;
          cursor: pointer;
      }
  </style>
</head>
<body>
    <nav class="fixed-top">
        <ul>
                <li><a href="http://localhost/web/ParcialII/contacto.html">Contacto</a></li>
                <li><a href="http://localhost/web/ParcialII/sobre-nosotros.html">Sobre Nosotros</a></li>
                <li><a href="http://localhost/web/ParcialII/biblioteca.html">Biblioteca</a></li>
                <li><a href="http://localhost/web/ParcialII/pagina.html">Inicio</a></li>
            <li><a href="http://localhost/web/ParcialII/cerrarsesion.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
    <div class="wrapper margen">
    <div class="content">
        <h2 class="center">¡Bienvenido a The Virtual Bookstore!</h2>
<form id="searchForm" method="POST">
    <div class="name">
        <label for="usuario">Usuario: </label>
        <div class="form-group">
             <input type="text" id="usuario" name="usuario" required value="<?php echo isset($resultado['usuario']) ? $resultado['usuario'] : ''; ?>" />
        </div>
    </div>
    <br />
    <div>
        <label for="pass">Contraseña: </label>
        <div class="form-group">
            <input type="password" id="pass" name="pass" value="<?php echo isset($resultado['pass']) ? $resultado['pass'] : ''; ?>" />
        </div>
    </div>
    <br />
    <div>
        <label for="email">Email: </label>
        <div class="form-group">
            <input type="email" id="email" name="email" value="<?php echo isset($resultado['email']) ? $resultado['email'] : ''; ?>" />
        </div>
    </div>
    <br />
    <div>
        <label for="telefono">Teléfono: </label>
        <div class="form-group">
            <input type="text" id="telefono" name="telefono" value="<?php echo isset($resultado['telefono']) ? $resultado['telefono'] : ''; ?>" />
        </div>
    </div>
    <br />
    <div>
        <label for="identificacion">Identificación: </label>
        <div class="form-group">
            <input type="text" id="identificacion" name="identificacion" value="<?php echo isset($resultado['identificacion']) ? $resultado['identificacion'] : ''; ?>" />
        </div>
    </div>
    <br>
    <br>
    <div class="center">
        <!-- Asigna diferentes valores a cada botón de envío -->
        <button type="submit">Buscar Mi Información</button>
        <button type="submit" name="actualizar">Actualizar Mi Información</button>
        <button type="submit" name="eliminar">Eliminar Mi Cuenta</button>
        <br>
        <br>
    </div>
</form>
            <p>
        <?php echo isset($message) ? $message : ""; ?>
    </p>
    </div>

  </div>
</div>
    <br>
    <br>
    <nav class="footer-nav">
        <ul>
                <li><a href="http://localhost/web/ParcialII/cerrarsesion.php">Cerrar Sesión</a></li>
                <li><a href="http://localhost/web/ParcialII/contacto.html">Contacto</a></li>
                <li><a href="http://localhost/web/ParcialII/sobre-nosotros.html">Sobre Nosotros</a></li>
                <li><a href="http://localhost/web/ParcialII/biblioteca.html">Biblioteca</a></li>
                <li><a href="http://localhost/web/ParcialII/pagina.html">Inicio</a></li>
        </ul>
    </nav>
    <br />
    <br />
</body>
</html>
