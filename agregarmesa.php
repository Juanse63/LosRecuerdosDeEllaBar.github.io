<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Pedido.css">
    <title>Agregar mesa</title>
</head>
<body>
    <h1>Agregar mesa</h1>

    <div class="contact_form">
        <div class="formulario">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="formulario_mesa">
                <label for="numero_mesa">Número de mesa:</label>
                <input type="text" id="numero_mesa" name="numero_mesa" required>

                <input type="hidden" name="estado_mesa" value="disponible">
                

                <button type="submit" id="btn_agregar">Agregar mesa</button>

                <button onclick="window.location.href='pedido.php'" class="btn_volver">Volver</button>
            </form>
        </div>
    </div>

    <script>
        const formulario = document.getElementById('formulario_mesa');
        const btnAgregar = document.getElementById('btn_agregar');

        formulario.addEventListener('submit', (event) => {
            event.preventDefault();

            const numeroMesa = document.getElementById('numero_mesa').value;

            if (confirm(`¿Está seguro de que desea agregar la mesa ${numeroMesa} al sistema?`)) {
                formulario.submit();
            }
        });
    </script>

    <?php
    
    include("conexion.php");

    if (isset($_POST["numero_mesa"])) {
        $numero_mesa = $_POST["numero_mesa"];
        $estado_mesa = "disponible";

        $sql = "INSERT INTO mesas (numero_mesa, estado_mesa) VALUES ('$numero_mesa', '$estado_mesa')";

        if ($conexion->query($sql) === TRUE) {
            echo "<p>Mesa agregada correctamente</p>";
        } else {
            echo "<p>Error: " . $conexion->error . "</p>";
        }

        $conexion->close();
    }
    ?>
</body>
</html>