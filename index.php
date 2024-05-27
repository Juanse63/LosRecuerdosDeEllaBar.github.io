<?php 
require 'conexion.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = $_POST['Nombre_Usuario'];
    $contrasena = $_POST['Contrasena'];

    $query = "SELECT id_cargo FROM registro WHERE Nombre_Usuario = '$nombreUsuario' AND contrasena = '$contrasena'";
    $resultado = mysqli_query($conexion, $query);
    if (mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_assoc($resultado);
        $id_cargo = $fila['id_cargo'];
        
        if ($id_cargo == 1) {
            header("Location: administrador.html");
        } elseif ($id_cargo == 2) {
            header("Location: mesero.html");
        } elseif ($id_cargo == 3) {
            header("Location: cajero.html");
        }
    } else {
        echo '<script>alert("El usuario no existe o los datos son incorrectos.");</script>';
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
        
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">   
        <div class="left"><img src="bar.jpg"></div>

        <div class="rigth">
            <img class="logo" src="LOGO.png" alt="">
            <h1>Iniciar Sesión</h1>

            <div class="entry">
                <input type="text" name="Nombre_Usuario" placeholder="Nombre de Usuario">
                <input type="password" name="Contrasena" placeholder="Contraseña">
            </div>
            <input class="special-input" type="submit" name="Enviar" value="Iniciar sesión">
        </div>
    </form> 

</body>
</html>
