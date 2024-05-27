<?php
$id = $_POST['id'];
$cantidad = $_POST['cantidad'];
include("conexion.php");


if ($cantidad > 0) {
    
    $sql = "SELECT cantidad_producto FROM inventario WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql);
    $producto = mysqli_fetch_assoc($resultado);

   
    $nuevaCantidad = $producto['cantidad_producto'] + $cantidad;

    
    $sqlActualizar = "UPDATE inventario SET cantidad_producto = $nuevaCantidad WHERE id = $id";
    if (mysqli_query($conexion, $sqlActualizar)) {
        echo "<script>alert('Cantidad agregada correctamente'); window.location.href = 'inventario.php';</script>";
    } else {
        echo "<script>alert('Error al agregar cantidad'); window.location.href = 'inventario.php';</script>";
    }
} else {
    echo "<script>alert('La cantidad debe ser un número positivo'); window.location.href = 'inventario.php';</script>";
}

mysqli_close($conexion);
?>