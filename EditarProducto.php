<?php
    include("conexion.php");


    if(isset($_POST['enviar'])){

        $id = $_POST['id'];
        $nombre_producto = $_POST['nombre_producto'];
        $proovedor = $_POST['proovedor'];
        $costo = $_POST['costo'];
        $venta = $_POST['venta'];

        $sql = "UPDATE productos SET nombre_producto='$nombre_producto', proovedor='$proovedor', costo='$costo', venta='$venta' WHERE id='$id'";
        $resultado = mysqli_query($conexion, $sql);

        if($resultado){
            echo "<script language='JavaScript'>alert('Los datos se actualizaron correctamente');location.assign('productos.php');</script>";
        } else {
            echo "<script language='JavaScript'>alert('Error');location.assign('productos.php');</script>";
        }
        mysqli_error($conexion);
    }

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM productos WHERE id='" . $id . "'";
        $resultado = mysqli_query($conexion, $sql);

        if(mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);
            $nombre_producto = $fila["nombre_producto"];
            $proovedor = $fila["proovedor"];
            $costo = $fila["costo"];
            $venta = $fila["venta"];
        } else {
            echo "No se encontró el usuario con el ID proporcionado.";
        }

        mysqli_free_result($resultado);
    }
    
    mysqli_close($conexion);
?>


<html>
    <head>
        <link rel="stylesheet" href="agregarPr.css">
        <title>EDITAR</title>
    </head>
    <body>
</body>
<body>
    <div class="contact_form">
        <div class="formulario">
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <div class="entry">
                    <p>Nombre del producto</p>
                    <input type="text" name="nombre_producto" placeholder="Nombre del producto" value="<?php echo $nombre_producto; ?>" required>
                    <p>Proovedor del producto</p>
                    <input type="text" name="proovedor" placeholder="Nombre del proovedor" value="<?php echo $proovedor; ?>" required>
                    <p>Costo del producto</p>
                    <input type="text" name="costo" placeholder="Ingrese el costo del producto" value="<?php echo $costo; ?>" required>
                    <p>Valor de venta del producto</p>
                    <input type="text" name="venta" placeholder="Ingrese el valor de venta del producto" value="<?php echo $venta; ?>" required>
                
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                </div>  
                <button class="special-input" type="submit" name="enviar">ACTUALIZAR</button>
                <ul class="navigation">
                </ul>
            </form>
        <div class="formulario">
    </div>        
</body>


