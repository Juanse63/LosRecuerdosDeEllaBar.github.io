<?php
    include("conexion.php");


    if(isset($_POST['enviar'])){

        $id = $_POST['id'];
        $nombreCompleto = $_POST['Nombre_Completo'];
        $id_cargo = $_POST['id_cargo'];
        $nombreUsuario = $_POST['Nombre_Usuario'];
        $contrasena = $_POST['Contrasena'];

        $sql = "UPDATE registro SET Nombre_Completo='$nombreCompleto', id_cargo='$id_cargo', Nombre_Usuario='$nombreUsuario', Contrasena='$contrasena' WHERE id='$id'";
        $resultado = mysqli_query($conexion, $sql);

        if($resultado){
            echo "<script language='JavaScript'>alert('Los datos se actualizaron correctamente');location.assign('MostrarUsers.php');</script>";
        } else {
            echo "<script language='JavaScript'>alert('Error');location.assign('MostrarUsers.php');</script>";
        }
        mysqli_error($conexion);
    }

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM registro WHERE id='" . $id . "'";
        $resultado = mysqli_query($conexion, $sql);

        if(mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);
            $nombreCompleto = $fila["Nombre_Completo"];
            $id_cargo = $fila["id_cargo"];
            $nombreUsuario = $fila["Nombre_Usuario"];
            $contrasena = $fila["Contrasena"];
        } else {
            echo "No se encontró el usuario con el ID proporcionado.";
        }

        mysqli_free_result($resultado);
    }
    
    mysqli_close($conexion);
?>

<html>
    <head>
        <title>EDITAR</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
</body>
<body>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <div class="left"><img src="bar.jpg"></div>
    <div class="rigth-register">
            <img class="logo" src="LOGO.png" alt="">
        <div class="entry">
            <p>Ingrese Nombre Completo</p>
            <input type="text" name="Nombre_Completo" placeholder="Ingrese Nombre Completo" value="<?php echo $nombreCompleto; ?>" required>
            <p>Seleccione el cargo</p>
            <select id="id_cargo" name="id_cargo" required>
                <option value="" disabled hidden>Seleccione su cargo</option>
                <option value="2" <?php if($id_cargo == 2) echo "selected"; ?>>Mesero</option>
                <option value="3" <?php if($id_cargo == 3) echo "selected"; ?>>Cajero</option>
            </select>
            <p>Ingrese Nombre Usuario</p>
            <input type="text" name="Nombre_Usuario" placeholder="Ingrese Nombre de Usuario" value="<?php echo $nombreUsuario; ?>" required>
            <p>Ingrese Contraseña</p>
            <input type="password" name="Contrasena" placeholder="Ingrese su Contraseña" value="<?php echo $contrasena; ?>" required>
        
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        </div>  
        <input class="special-input" type="submit" name="enviar" value="ACTUALIZAR">
        <ul class="navigation">
            <li><a href="MostrarUsers.php">Volver</a></li>
                <li><a href="administrador.html">Inicio</a></li>
        </ul>
    </form>
</body>
</html>