<?php
include('conexion.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualizar Inventario</title>
</head>
<body>
  <h1>Actualizar Inventario</h1>

  <?php


  $sqlProductos = "SELECT id, nombre_producto FROM productos";
  $stmtProductos = $conexion->prepare($sqlProductos);
  $stmtProductos->execute();
  $stmtProductos->bind_result($idProducto, $nombreProducto);

  ?>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="producto">Producto:</label>
    <select id="producto" name="producto" required>
      <option value="">Seleccionar Producto</option>

      <?php
      while ($stmtProductos->fetch()) {
        echo "<option value='$idProducto'>$nombreProducto</option>";
      }
      $stmtProductos->close();
      ?>
    </select><br>

    <label for="cantidadProducto">Cantidad Producto:</label>
    <input type="number" id="cantidadProducto" name="cantidadProducto" min="1" required><br>

    <button type="submit">Actualizar Inventario</button>
  </form>

  <?php

  if (isset($_POST['producto'])) {
    $idProducto = $_POST['producto'];
    $cantidadProducto = $_POST['cantidadProducto'];
    $sqlInventario = "UPDATE inventario SET cantidad_producto = ? WHERE codigo = ?";
    $stmtInventario = $conexion->prepare($sqlInventario);
    $stmtInventario->bind_param("ii", $cantidadProducto, $idProducto);


    if ($stmtInventario->execute()) {
        echo "<p class='exito'>Inventario actualizado correctamente.</p>";
    } else {
        echo "<p class='error'>Error al actualizar inventario: " . $conexion->error . "</p>";
    }

    $stmtInventario->close();
    $conexion->close();
  }

  ?>

</body>
</html>