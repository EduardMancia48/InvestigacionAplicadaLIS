<?php 

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}


?>
<table>
  <tr>
    <th>Nombre</th>
    <th>Precio</th>
    <th>Cantidad</th>
    <th>Total</th>
  </tr>
  <?php
  // Iterar a través de los elementos del carrito
  foreach ($_SESSION['carrito'] as $producto) {
    echo "<tr>";
    echo "<td>" . $producto['nombre'] . "</td>";
    echo "<td>" . $producto['precio'] . "</td>";
    echo "<td>" . $producto['cantidad'] . "</td>";
    echo "<td>" . $producto['precio'] * $producto['cantidad'] . "</td>";
    echo "</tr>";
  }




  
  ?>
</table>
