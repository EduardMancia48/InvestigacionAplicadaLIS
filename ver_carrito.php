<?php
session_start();
?>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito de compras</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>

<body>
  <div class="container my-4">
    <h1 class="text-center mb-4">Carrito de compras</h1>
    <div class="row">
      <div class="col">
        <?php
        // Si el carrito está vacío, se muestra un mensaje indicándolo
        if (empty($_SESSION['carrito'])) {
          echo "<p class='text-center'>No hay productos en el carrito</p>";
        } else {
          // Si el carrito tiene productos, se muestran en una tabla
          echo "<form id='form-carrito' action='ver_carrito.php' method='POST'>";
          echo "<table class='table table-striped'>";
          echo "<thead>";
          echo "<tr>";
          echo "<th>Nombre</th>";
          echo "<th>Descripción</th>";
          echo "<th>Precio</th>";
          echo "<th>Cantidad</th>";
          echo "<th>Acciones</th>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";

          $total = 0; // Variable para almacenar el total

          foreach ($_SESSION['carrito'] as $indice => $producto) {

            echo "<tr>";
            echo "<td>" . $producto['nombre'] . "</td>";
            echo "<td>" . $producto['descripcion'] . "</td>";
            echo "<td>$" . number_format($producto['precio'], 2) . "</td>";
            echo "<td>";
            echo "<td><span style='left:-80px ;position:relative;'>" . $producto['cantidad'] . "</span></td>";


            echo "</td>";

            echo "<form action='eliminar_carrito.php' method='POST'>";
            echo "<td style='left:-105px; position:relative'> ";
            echo "<input type='hidden' name='indice' value='$indice'>";
            echo "<button type='submit' class='btn btn-sm btn-danger'>Eliminar</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";

            $total += $producto['precio'] * $producto['cantidad']; // Sumamos el precio por la cantidad del producto actual
          }
          // Mostramos la fila con el total
          echo "<tr>";
          echo "<td colspan='2'></td>";
          echo "<td>Total:</td>";
          echo "<td id='total'>$" . number_format($total, 2) . "</td>";
          echo "<td></td>";
          echo "</tr>";

          echo "</tbody>";
          echo "</table>";
          echo "<div class='text-right'>";
          echo   "<form action='solicitar_cotizacion.php' method='POST'>";
          echo "<button type='submit' class='btn btn-success'>Solicitar cotización</button>";
          echo "</form>";

          echo "<button type='submit' class='btn btn-primary' style='margin-bottom: 10px;'>Actualizar carrito</button>";
          echo "<form action='borrar_carrito.php' method='POST'>";
          echo "<button type='submit' class='btn btn-danger'>Vaciar carrito</button>";
          echo "</form>";

          echo "</div>";
          echo "</form>";

          // Si se ha enviado el formulario para actualizar el carrito
          if (isset($_POST['cantidad']) && isset($_POST['indice'])) {
            // Recorremos los productos del carrito para actualizar
            foreach ($_POST['cantidad'] as $key => $cantidad) {
              // Obtenemos el índice del producto actual
              $indice = $_POST['indice'][$key];
              // Actualizamos la cantidad del producto correspondiente en el carrito
              $_SESSION['carrito'][$indice]['cantidad'] = $cantidad;
            }

            // Redireccionamos al usuario al carrito para refrescar la página
            header('Location: ver_carrito.php');
          }
        }


        ?>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>