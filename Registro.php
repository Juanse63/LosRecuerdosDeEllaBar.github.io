<?php 
require 'conexion.php';

$message = '';

if (isset($_POST['Enviar'])) {
    $nombreCompleto = htmlspecialchars($_POST['Nombre_Completo'] ?? null);
    $id_cargo = htmlspecialchars($_POST['id_cargo'] ?? null);

    if ($nombreCompleto !== null && $id_cargo !== null) {
        $nombreUsuario = htmlspecialchars($_POST['Nombre_Usuario']);
        $contraseña = htmlspecialchars($_POST['Contraseña']);

        $sql = "INSERT INTO registro (Nombre_Completo, id_cargo, Nombre_Usuario, Contrasena) VALUES ('$nombreCompleto', '$id_cargo', '$nombreUsuario', '$contraseña')";


        try {
            $stmt = $conexion->query($sql);
            if ($stmt) {
                $message = "Registro exitoso";
            } else {
                $message = "Error al registrar";
            }
        } catch (PDOException $e) {
            $message = "Error al ejecutar la consulta: " . $e->getMessage();
        }
    } else {
        $message = "Nombre completo y cargo son campos requeridos";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<script>

function mostrarMensaje(message) {
    var popup = document.createElement('div');
    popup.className = 'popup';
    

    var messageElement = document.createElement('p');
    messageElement.textContent = message;
    popup.appendChild(messageElement);
    
    popup.style.position = 'fixed';
    popup.style.top = '50%';
    popup.style.left = '50%';
    popup.style.transform = 'translate(-50%, -50%)';
    popup.style.padding = '20px';
    popup.style.background = '#fff';
    popup.style.border = '1px solid #000';
    popup.style.boxShadow = '0 0 10px rgba(0,0,0,0.5)';
    popup.style.zIndex = '9999';
    

    document.body.appendChild(popup);
    
    popup.addEventListener('click', function() {
        document.body.removeChild(popup);
    });
}

<?php if (!empty($message)): ?>
    mostrarMensaje('<?php echo $message; ?>');
<?php endif; ?>
</script>
    
    
    <form action="Registro.php" method="post">        
        <div class="left"><img src="bar.jpg"></div>
        
        <div class="rigth-register">
            <img class="logo" src="LOGO.png" alt="">
            <h1 class="registerH1">Registrarse</h1>

            <div class="entry">
            <input type="text" name="Nombre_Completo" placeholder="Ingrese Nombre Completo" required>
            <select type="text" id="id_cargo" placeholder="Ingrese su Cargo" name="id_cargo">
            <option value="" disabled selected hidden>Seleccione su cargo</option>
            <option value="2">Mesero</option>
            <option value="3">Cajero</option>
            </select>
            <input type="text" name="Nombre_Usuario" placeholder="Ingrese Nombre de Usuario" required>
            <input type="password" name="Contraseña" placeholder="Ingrese su Contraseña" required>
            </div>  
            <input class="special-input" type="submit" name="Enviar">
            <samp> <a href="administrador.html">Volver</a> </samp>
    </form> 
</body>
</html>
