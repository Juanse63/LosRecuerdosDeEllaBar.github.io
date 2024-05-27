<!DOCTYPE html>
<html>
<head>
    <title>Inventario</title>
    <script type="text/javascript"> 
        function confirmar(){
            return confirm('¿Está seguro?, se eliminarán los datos');
        }
    </script>
    <link rel="stylesheet" href="styleIN.css">
</head>
<body>

<?php
    include("conexion.php");
    $sql = "SELECT * FROM inventario";
    $resultado = mysqli_query($conexion, $sql);
?>

<div class="container-left">
        <nav>
            <ul class="navigation">
                <li><a href="administrador.html">Inicio</a></li>
                <li><a href="finsesion.html">Cerrar Sesión</a></li>
            </ul>
        </nav>
        <div class="H"><h1>Inventario</h1></div>
    </div>

<div class="container">      
    <table>
        <thead>
            <tr>
                <th>Nombre producto</th>
                <th>Cantidad existente</th>
                <th>Código producto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($filas = mysqli_fetch_assoc($resultado)){
            ?>
                <tr>
                    <td><?php echo $filas['nombre_producto']?></td> 
                    <td><?php echo $filas['cantidad_producto']?></td> 
                    <td><?php echo $filas['codigo']?></td> 
                    <td>
                        <form action="AgregarCantidad.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $filas['id']?>">
                            <input type="number" name="cantidad" min="1" value="1">
                            <button type="submit">AÑADIR CANTIDAD</button>
                        </form>

                    </td>
                </tr> 
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php 
mysqli_close($conexion);
?>
</body>
</html>