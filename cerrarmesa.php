<?php
    include("conexion.php");

    if (isset($_POST['mesa'])) {
        $idMesa = $_POST['mesa'];
        
        
        $sql = "SELECT p.nombre_producto, d.cantidad, p.venta, d.precio_total
                FROM productos p
                JOIN pedidos d ON p.id = d.id_producto
                WHERE d.id_mesa = $idMesa";
        $resultPedido = mysqli_query($conexion, $sql);

        
        $total = 0;
        while ($row = mysqli_fetch_assoc($resultPedido)) {
            $total += $row['precio_total'];
        }

        
        $totalPagar = $total;
    }

    if (isset($_POST['cerrarMesa'])) {
        $idMesa = $_POST['idMesa'];
        $total = $_POST['total'];

        
        $sql = "UPDATE mesas SET estado_mesa = 'Cerrada' WHERE idmesa = $idMesa";
        mysqli_query($conexion, $sql);

        
        $sql = "DELETE FROM pedidos WHERE id_mesa = $idMesa";
        mysqli_query($conexion, $sql);

        echo "<script>alert('Mesa cerrada exitosamente. Pago registrado.')</script>";
    }

   
    $sqlMesas = "SELECT idmesa, numero_mesa FROM mesas WHERE estado_mesa IN ('Disponible', 'Ocupada')";
    $resultMesas = mysqli_query($conexion, $sqlMesas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar y Cerrar Mesa</title>
    <link rel="stylesheet" href="CerrarPe.css">
</head>
<body>
<div class="container-left">
        <nav>
            <ul class="navigation">
                <li><a href="cajero.html">Inicio</a></li>
            </ul>
        </nav>
        <div class="H"><h1>Pagar y Cerrar Mesa</h1></div>
    </div>

    <div class="contact_form">
        <div class="formulario">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="mesa">Seleccionar Mesa:</label>
                <select class="select_producto" id="mesa" name="mesa" required>
                    <option value="">Seleccionar mesa</option>
                    <?php while ($row = mysqli_fetch_assoc($resultMesas)) : ?>
                        <option value="<?php echo $row['idmesa']; ?>"><?php echo $row['numero_mesa']; ?></option>
                    <?php endwhile; ?>
                </select>

                <button type="submit" name="verDetalles">Ver detalles</button>
            </form>

            <?php if (isset($_POST['mesa'])) : ?>
                <h2>Detalles del Pedido</h2>
                <table border=1>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        mysqli_data_seek($resultPedido, 0);
                        while ($row = mysqli_fetch_assoc($resultPedido)) : ?>
                            <tr>
                                <td><?php echo $row['nombre_producto']; ?></td>
                                <td><?php echo $row['cantidad']; ?></td>
                                <td><?php echo $row['venta']; ?></td>
                                <td><?php echo $row['precio_total']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total:</td>
                            <td><?php echo $totalPagar; ?></td>
                        </tr>
                    </tbody>
                </table>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="idMesa" value="<?php echo $idMesa; ?>">
                    <input type="hidden" name="total" value="<?php echo $totalPagar; ?>">
                    <button type="submit" name="cerrarMesa">Pagar y Cerrar Mesa</button>

                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
