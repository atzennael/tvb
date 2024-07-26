<?php
// Inicializa el carrito de compras si aún no está inicializado
session_start();
error_reporting(E_ERROR | E_PARSE);
// Verificar si se ha enviado una solicitud POST para limpiar el carrito
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["limpiar_carrito"])) {
    // Limpiar el carrito eliminando las variables de sesión
    unset($_SESSION["productos"]);
    unset($_SESSION["precios"]);
    // Redirigir nuevamente a esta página para evitar el reenvío del formulario
    header("Location: {$_SERVER['PHP_SELF']}");
    exit; // Asegurar que el script se detenga después de la redirección
}
// Verifica si se han enviado productos al carrito
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["producto"]) && isset($_POST["precio"])) {
    // Obtener el producto y el precio del formulario
    $producto = $_POST["producto"];
    $precio = $_POST["precio"];

    // Agregar el producto y el precio al carrito
    $_SESSION["productos"][] = $_POST["producto"];
    $_SESSION["precios"][] = $_POST["precio"];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TVB - Carrito</title>
    <style>
        /* Estilos para la tabla */
        body {
        font-family: Arial, sans-serif;
        background-color: white;
        }
        table {
    border-collapse: collapse;
    width: 900px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #AA7EEE;
            color: white;
        }
        /* Estilos para el total */
        .total {
            margin-top: 20px;
            font-size: 18px;
            text-align: right;
            margin-right: 215px;
        }
        .center {
            text-align: center;
            align-content: center;
            align-items: center;
        }
            nav {
        background-color: #AA7EEE;
        color: white;
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
      .footer-nav {
          position: fixed;
          bottom: 0;
          width: 100%;
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
  background-color: #AA7EEE;
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
              .fixed-top {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
            height: 40px;
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
        </ul>
    </nav>
    <div class="wrapper">
        <div class="container">
            <h1 class="center">Carrito de Compras</h1>
            <?php if (!empty($_SESSION["productos"])) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($_SESSION["productos"]); $i++) : ?>
                            <tr>
                                <td><?= $_SESSION["productos"][$i] ?></td>
                                <td>$<?= $_SESSION["precios"][$i] ?></td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
                <?php
                // Calcular el total
                $total = array_sum($_SESSION["precios"]);
                ?>
                <p class="total">Total: $<?= number_format($total, 2) ?></p>
                <div class="center">
                <a href="http://localhost/web/ParcialII/checkout.html"><button class="center">Ir a Pagar</button></a>
                <a href="http://localhost/web/ParcialII/biblioteca.html" target="_blank"><button class="center">Seguir Comprando</button></a>
            </div>
            <br>
            <br>
            <?php else : ?>
                <p class="center">No hay productos en el carrito.</p>
            <?php endif; ?>
            <!-- Formulario para limpiar el carrito -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="limpiar_carrito" value="1">
                <div class="center">
                <button type="submit">Limpiar Carrito</button>
            </div>
            </form>
        </div>
    </div>
        <nav class="footer-nav">
        <ul>
                <li><a href="http://localhost/web/ParcialII/contacto.html">Contacto</a></li>
                <li><a href="http://localhost/web/ParcialII/sobre-nosotros.html">Sobre Nosotros</a></li>
                <li><a href="http://localhost/web/ParcialII/biblioteca.html">Biblioteca</a></li>
                <li><a href="http://localhost/web/ParcialII/pagina.html">Inicio</a></li>
        </ul>
    </nav>
    <br>
    <br>
</body>
</html>