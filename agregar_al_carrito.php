<?php 
session_start();

if(isset($_POST['Agregar'])){

    $producto = array(
        'nombre' => $_POST['nombre'],
        'descripcion' => $_POST['descripcion'],
        'precio' => $_POST['precio'],
        'imagen' => $_POST['imagen'],
        'cantidad' => 1
    );

    // Si el carrito está vacío, se crea una sesión "carrito" y se agrega el primer producto
    if(empty($_SESSION['carrito'])){
        $_SESSION['carrito'][0] = $producto;
        echo "<script>alert('Producto agregado al carrito');</script>";
    }
    else{
        // Si el carrito ya tiene productos, se verifica si el producto que se quiere agregar ya está en el carrito
        $idsProductos = array_column($_SESSION['carrito'], 'nombre');

        if(in_array($_POST['nombre'], $idsProductos)){
            // Si el producto ya está en el carrito, se incrementa la cantidad
            foreach($_SESSION['carrito'] as $indice => $prod){
                if($prod['nombre'] == $_POST['nombre']){
                    $_SESSION['carrito'][$indice]['cantidad'] += 1;
                    break;
                }
            }
            echo "<script>alert('La cantidad del producto se actualizó en el carrito');</script>";
        }
        else{
            // Si el producto no está en el carrito, se agrega al final del arreglo
            $numProductos = count($_SESSION['carrito']);
            $_SESSION['carrito'][$numProductos] = $producto;
            echo "<script>alert('Producto agregado al carrito ' );</script> ";
        }
    }
}
header("Location: ver_carrito.php");

?>
