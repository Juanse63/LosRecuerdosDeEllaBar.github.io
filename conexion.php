<?php
$servidor = "localhost";
$usuario_bd = "root";
$contraseña_bd = "";
$nombre_bd = "login_database";

$conexion = mysqli_connect($servidor, $usuario_bd, $contraseña_bd, $nombre_bd);

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
