<?php
    $id=$_GET['id'];
    include("conexion.php");

    $sql="DELETE FROM registro WHERE id='" . $id . "'";
    $resultado=mysqli_query($conexion,$sql);

    if($resultado){
        echo "<script language='JavaScript'>alert('El dato se elimino correctamente');location.assign('MostrarUsers.php');</script>";
    } else {
        echo "<script language='JavaScript'>alert('Error');location.assign('MostrarUsers.php');</script>";
    }
    mysqli_error($conexion);
?>