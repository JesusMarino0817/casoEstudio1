<?php
include("conexion.php");
session_start();
$tittle = $_POST['tittle'];
$autor = $_POST['autor'];
$description = $_POST['description'];
$editorial = $_POST['editorial'];
$genre = $_POST['genre'];
$amount = $_POST['amount'];
$price = $_POST['price'];
$isbn = $_SESSION['isbn'];

$sql = "UPDATE book SET tittle = '$tittle', genre = '$genre', autor = '$autor',
amount = '$amount', editorial = '$editorial', description = '$description', price = '$price' WHERE isbn = '$isbn'";
if(mysqli_query($conn, $sql)) {
    echo'<script type="text/javascript">
            alert("Modificación realizada con exito.");
            window.location.href="index.php";
        </script>';
} else {
    echo'<script type="text/javascript">
            alert("Error en la modificación, vuelva a intentarlo.");
        </script>';
}