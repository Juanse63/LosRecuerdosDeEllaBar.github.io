<?php
    include("conexion.php");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="agregarPr.css">
  <title>Agregar Producto</title>
</head>
<body>
<div class="contact_form">

  <div class="formulario">
      <h1>Agregar Producto</h1>
      
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="nombre_producto">Nombre del Producto:</label>
        <input type="text" id="nombre_producto" name="nombre_producto" required><br>

        <label for="proovedor">Proovedor:</label>
        <input type="text" id="proovedor" name="proovedor" required><br>

        <label for="costo">Costo:</label>
        <input type="number" step="0.01" id="costo" name="costo" required><br>

        <label for="venta">Venta:</label>
        <input type="number" step="0.01" id="venta" name="venta" required><br>

        <button type="submit">Agregar Producto</button>
        <button onclick="window.location.href='productos.php'">Volver a Productos</button>

      </form>

      <?php

      if (isset($_POST['nombre_producto'])) {
        $nombre_producto = $_POST['nombre_producto'];
        $proovedor = $_POST['proovedor'];
        $costo = $_POST['costo'];
        $venta = $_POST['venta'];

        $sql = "INSERT INTO productos (nombre_producto, proovedor, costo, venta) VALUES (?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);

        $stmt->bind_param("ssss", $nombre_producto, $proovedor, $costo, $venta);

        if ($stmt->execute()) {
            echo "<p class='exito'>Producto agregado correctamente</p>";
        } else {
            echo "<p class='error'>Error al agregar producto: " . $conexion->error . "</p>";
        }

        $conexion->close();
      }

    ?>
  </div>
</div>
</body>
</html>

