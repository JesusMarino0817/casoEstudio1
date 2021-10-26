<?php
$myName = $_POST['name'];
$last1 = $_POST['last1'];
$last2 = $_POST['last2'];
$email = $_POST['email'];
$pass = $_POST['pass'];

include("conexion.php");

$sql = "INSERT INTO user(name, last_name1, last_name2, email, pass, type)
VALUES ('$myName','$last1', '$last2', '$email', '$pass', '2')";

if (mysqli_query($conn, $sql)) {
    echo'<script type="text/javascript">
            alert("Registro exitoso");
            window.location.href="index.php";
        </script>';
} else {
    echo '<script type="text/javascript">
            alert("Fallo en el registro.");
            window.location.href="Nuevo-Registro.php";
        </script>';
}