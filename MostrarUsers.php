<html>
    <head>
        <title>Lista de Usuarios</title>
        <script type="text/javascript"> function confirmar(){
            return confirm('¿Esta seguro?, se eliminaran los datos');
        }
        </script>
        <link rel="stylesheet" href="styleMU.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    </head>

<body>

<?php
    include("conexion.php");
    $sql="SELECT * FROM registro";
    $resultado = mysqli_query($conexion,$sql);

?>
    <div class="container-left">
        <nav>
            <ul class="navigation">
                <li><a href="administrador.html">Inicio</a></li>
                <li><a href="finsesion.html">Cerrar Sesión</a></li>
            </ul>
        </nav>
        <div class="H"><h1>Usuarios Registrados</h1></div>
    </div>
    <div class="container">
        <table>
            <thead>
                <tr>
                    
                    <th>Nombre Completo</th>
                    <th>Cargo</th>
                    <th>Usuario</th>
                    <th>Constraseña</th>
                    <th>Editar</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                while($filas=mysqli_fetch_assoc($resultado)){
                ?>
                    <tr>
                        
                        <td><?php echo $filas['Nombre_Completo']?></td> 
                        <td><?php echo $filas['id_cargo']?></td> 
                        <td><?php echo $filas['Nombre_Usuario']?></td> 
                        <td><?php echo $filas['Contrasena']?></td>
                        <td>
                        <span class="edit-icon"><a href="EditarRegistro.php?id=<?php echo $filas['id']; ?>"><i class="fas fa-edit"></i></a></span>
                        <span class="delete-icon"><a href="EliminarRegistro.php?id=<?php echo $filas['id']; ?>" onclick="return confirmar()"><i class="fas fa-trash-alt"></i></a></span>
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