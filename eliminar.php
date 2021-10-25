<?php
include("conexion.php");
session_start();
$isbn = $_POST['isbn'];
echo $isbn;
$sql = "UPDATE book SET log_eliminacion = 'si' WHERE isbn = '$isbn'";

if(mysqli_query($conn, $sql)) {
    echo'<script type="text/javascript">
            alert("Registro eliminado.");
            window.location.href="index.php";
        </script>';
} else {
    echo'<script type="text/javascript">
            alert("Error al eliminar elemento.");
        </script>';
}