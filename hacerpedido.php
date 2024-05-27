<?php
include('conexion.php');


$queryProductos = "SELECT id, nombre_producto, venta FROM productos";
$resultProductos = mysqli_query($conexion, $queryProductos);

$queryMesas = "SELECT idmesa, numero_mesa FROM mesas";
$resultMesas = mysqli_query($conexion, $queryMesas);

if (isset($_POST['enviarPedido'])) {
  $idProducto = $_POST['producto'];
  $cantidad = $_POST['cantidad'];
  $idMesa = $_POST['mesa'];

  if ($idProducto == "" || $cantidad == "" || $idMesa == "") {
    $error = "Debes seleccionar un producto, una cantidad y una mesa.";
  } else {
    $queryInsertarPedido = "INSERT INTO pedidos (id_producto, cantidad, precio_total, id_mesa) VALUES ($idProducto, $cantidad, ($cantidad * (SELECT venta FROM productos WHERE id = $idProducto)), $idMesa)";
    mysqli_query($conexion, $queryInsertarPedido);

    $queryActualizarMesa = "UPDATE mesas SET estado_mesa = 'ocupada' WHERE idmesa = $idMesa";
    mysqli_query($conexion, $queryActualizarMesa);

    $mensaje = "Pedido realizado correctamente.";
  }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="Pedido.css">
  <title>Comandero </title> 
</head>
<body>

  <h1>Comandero del bar</h1>

  <?php if (isset($error)) : ?>
    <p style="color: red;"><?php echo $error; ?></p>
  <?php endif; ?>

  <?php if (isset($mensaje)) : ?>
    <p style="color: green;"><?php echo $mensaje; ?></p>
  <?php endif; ?>
  <div class="contact_form">
    <div class="formulario">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="producto">Producto:</label>
        <select class="select_producto" id="producto" name="producto">
          <option value="">Seleccionar producto</option>
          <?php while ($producto = mysqli_fetch_assoc($resultProductos)) : ?>
            <option value="<?php echo $producto['id']; ?>"><?php echo $producto['nombre_producto']; ?> (Venta: $<?php echo $producto['venta']; ?>)</option>
          <?php endwhile; ?>
        </select>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" min="1" value="1">

        <label for="mesa">Mesa:</label>
        <select class="select_producto" id="mesa" name="mesa">
          <option value="">Seleccionar mesa</option>
          <?php while ($mesa = mysqli_fetch_assoc($resultMesas)) : ?>
            <option value="<?php echo $mesa['idmesa']; ?>"><?php echo $mesa['numero_mesa']; ?></option>
          <?php endwhile; ?>
        </select>

        <button type="submit" name="enviarPedido">Enviar pedido</button>
        <button type="button" onclick="window.location.href='pedido.php'" class="btn_volver">Volver</button>
      </form>
    </div>
  </div>
</body>
</html>
