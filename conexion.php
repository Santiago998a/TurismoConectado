<?php
// conexion.php

$conexion = new mysqli('localhost', 'root', '', 'turismo_conectado');

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}
?>