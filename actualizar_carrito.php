<?php
session_start();

$indice = $_POST['indice'];
$cantidad = $_POST['cantidad'];

// Actualizar la cantidad del producto correspondiente en $_SESSION['carrito']
$_SESSION['carrito'][$indice]['cantidad'] = $cantidad;

// Devolver el contenido actualizado del carrito
include('ver_carrito.php');
?>
