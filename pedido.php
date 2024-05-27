<html>
    <head>
        <title>Realizar pedido</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Producto.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    </head>

<body>

<?php
    include("conexion.php");
    $sql="SELECT * FROM mesas";
    $resultado = mysqli_query($conexion,$sql);

?>
    <div class="container-left">
        <nav>
            <ul class="navigation">

                <li><a href="finsesion.html">Cerrar Sesión</a></li>
            </ul>
        </nav>
        <div class="H"><h1>Pedidos y mesas</h1></div>
    </div>
    <div class="container">
    <table>
            <thead>
                <tr>    
                    <th>Número de la mesa</th>
                    <th>Estado de la mesa</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                while($filas=mysqli_fetch_assoc($resultado)){
                ?>
                    <tr>
                        <td><?php echo $filas['numero_mesa']?></td> 
                        <td><?php echo $filas['estado_mesa']?></td> 
                    </tr> 
                <?php
                }
                ?>
            </tbody>
        </table>
        <button class="button-agregar" onclick="location.href='agregarmesa.php'">Agregar mesa</button>
        <button class="button-agregar" onclick="location.href='hacerpedido.php'">Hacer pedido</button>
        <button type="button" onclick="window.location.href='mesero.html'" class="btn_volver">Volver</button>





    </div>
        <?php 
        mysqli_close($conexion);
        ?>
</body>
</html>
