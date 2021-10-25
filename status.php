<?php
session_start();
include("conexion.php");
$status = $_POST['status'];
$code = $_SESSION['code'];

$sql = "UPDATE ventas SET status = '$status' WHERE sellCode = '$code'";
if(mysqli_query($conn, $sql)) {
    echo'<script type="text/javascript">
            alert("Estado cambiado con exito.");
            window.location.href="index.php";
        </script>';
} else {
    echo'<script type="text/javascript">
            alert("Error cambiando el estado.");
            window.location.href="index.php";
        </script>';
}