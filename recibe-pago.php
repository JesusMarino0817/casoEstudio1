<?php
session_start();
$isbn = $_SESSION['isbn'];
$id = $_SESSION['id'];
$date = date("Y-m-d");
$amount = $_POST['amount'];
$deliver = "";
$paqueteria = $_SESSION['paqueteria'];
$price = $_SESSION['price'] * $amount + (int)$_POST['deliver'];

if($_POST['deliver'] == 70) {
    $deliver = "Estandar";
} else {
    $deliver = "Rapido";
}

include("conexion.php");

$sql = "INSERT INTO ventas(idUsuario, isbnBook, dateBuy, amountSell, status, envio, precio, envioDist)
VALUES ('$id', '$isbn', '$date', '$amount', 'Enviando', '$deliver', '$price', '$paqueteria')";

if (mysqli_query($conn, $sql)) {
    $sql = "UPDATE book SET amount = amount - '$amount' WHERE isbn = '$isbn'";
    if(mysqli_query($conn, $sql)) {
        echo'<script type="text/javascript">
            alert("El envio ha empezado.");
            window.location.href="index.php";
        </script>';
    } else {
        echo '<script type="text/javascript">
            alert("Fallo en el registro.");
            window.location.href="index.php";
        </script>';
    }
} else {
    echo '<script type="text/javascript">
            alert("Fallo en el registro.");
            window.location.href="index.php";
        </script>';
}