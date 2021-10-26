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
$isbn = $_POST['isbn'];

$file = $_FILES['imagen']['name'];
if(isset($file) && $file != "") {
    $type = $_FILES['imagen']['type'];
    $size = $_FILES['imagen']['size'];
    $temp = $_FILES['imagen']['tmp_name'];
    if(!((strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png") ))) {
        echo  "<div><b>extensión no soportada</b></div>";
    } else {
        if(move_uploaded_file($temp, 'images/'.$file)) {
            chmod('images/'.$file, 0777);
        }
    }
}
$sql = "INSERT INTO book(isbn, tittle, genre, autor, amount, editorial, imagen, log_eliminacion, description, price) 
VALUES ('$isbn','$tittle', '$genre', '$autor', '$amount', '$editorial', '$file', 'no', '$description', '$price')";
if(mysqli_query($conn, $sql)) {
    echo'<script type="text/javascript">
        alert("Nuevo libro agregado con exito.");
        window.location.href="index.php";
        </script>';
    } else {
    echo'
        <script type="text/javascript">
        alert("Error al agregar el libro.");
        window.location.href="nuevo-libro.php";
        </script>';
    }