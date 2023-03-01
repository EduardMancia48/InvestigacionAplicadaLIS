<?php
session_start();

if(isset($_POST['indice'])){
    $indice = $_POST['indice'];
    unset($_SESSION['carrito'][$indice]);
}

header('Location: ver_carrito.php');
?>
