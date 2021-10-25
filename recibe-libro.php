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

$file = $_FILES['image']['name'];
if(isset($file) && $file != "") {
    $type = $_FILES['image']['type'];
    $size = $_FILES['image']['size'];
    $temp = $_FILES['image']['tmp_name'];
    if(!((strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png") ))) {
        echo  "<div><b>extensión no soportada</b></div>";
    } else {
        if(move_uploaded_file($temp, 'images/'.$file)) {
            chmod('images/'.$file, 0777);
        }
    }
}
$sql = "INSERT INTO book(isbn, tittle, genre, autor, amount, editorial, image, log_eliminacion, description, price) 
VALUES ('$isbn','$tittle', '$genre', '$autor', '$amount', '$editorial', '$file', 'no', '$description', '$price')";
if(mysqli_query($conn, $sql)) {
    echo'<script type="text/javascript">
        alert("Nuevo libro agregado con exito.");
        window.location.href="index.php";
        </script>';
    } else {
    echo'
        <script type="text/javascript">
        alert("Error al agregar el libro, compruebe que el isbn no este repetido.");
        window.location.href="index.php";
        </script>';
    }