<?php
$servidor = "localhost";
$usuario = "root";
$contra = "";
$dbname = "libreria";

//Crear conexion con MySQL
$conn = mysqli_connect($servidor, $usuario, $contra, $dbname) or die("Error al conectar la base de datos.");
header('Content-Type: text/html; charset=UTF-8');
$conn->set_charset("utf8");