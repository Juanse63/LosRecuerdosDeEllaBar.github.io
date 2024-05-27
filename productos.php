<html>
    <head>
        <title>Lista de Usuarios</title>
        <script type="text/javascript"> function confirmar(){
            return confirm('¿Esta seguro?, el producto se eliminará del inventario.');
        }
        </script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Producto.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    </head>

<body>

<?php
    include("conexion.php");
    $sql="SELECT * FROM productos";
    $resultado = mysqli_query($conexion,$sql);

?>
    <div class="container-left">
        <nav>
            <ul class="navigation">
                <li><a href="administrador.html">Inicio</a></li>
                <li><a href="finsesion.html">Cerrar Sesión</a></li>
            </ul>
        </nav>
        <div class="H"><h1>Productos</h1></div>
    </div>
    <div class="container">
        <table>
            <thead>
                <tr>
                    
                    <th>Nombre del producto</th>
                    <th>Proovedor</th>
                    <th>Costo</th>
                    <th>Venta</th>
                    <th>Ganancia</th>
                    <th>Editar</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                while($filas=mysqli_fetch_assoc($resultado)){
                ?>
                    <tr>
                        
                        <td><?php echo $filas['nombre_producto']?></td> 
                        <td><?php echo $filas['proovedor']?></td> 
                        <td><?php echo $filas['costo']?></td> 
                        <td><?php echo $filas['venta']?></td>
                        <td><?php echo $filas['ganancia']?></td>
                        <td>
                        <span class="edit-icon"><a href="EditarProducto.php?id=<?php echo $filas['id']; ?>"><i class="fas fa-edit"></i></a></span>
                        <span class="delete-icon"><a href="EliminarProducto.php?id=<?php echo $filas['id']; ?>" onclick="return confirmar()"><i class="fas fa-trash-alt"></i></a></span>
                        </td>
                    </tr> 
                <?php
                }
                ?>
            </tbody>
        </table>
        <button class="button-agregar" onclick="location.href='agregarproducto.php'">Agregar producto</button>


    </div>
        <?php 
        mysqli_close($conexion);
        ?>
</body>
</html>