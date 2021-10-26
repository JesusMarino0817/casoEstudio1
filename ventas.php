<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,500;1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
</head>
<body style="background: #000000;">
<?php 
session_start();
include("conexion.php");
$type = isset($_SESSION['type']) && $_SESSION['type'] == 1 ? "1" : "2";
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-logo" href="index.php">Libreria de libros</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
                if($type == 1) {
                    echo "<a class='mx-2 btn btn-primary' href='admin.php'>Administración</a>";
                }
            ?>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <form class="d-flex" action="buscador.php" method="post">
                    <input class="form-control me-2" name="search" type="search" placeholder="Buscar" aria-label="Buscar">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                    <?php
                    if(!isset($_SESSION['email'])) {
                        echo "
                        <div class='container-fluid'>
                            <a class='btn btn-primary' href='login.php'>Entrar</a>
                            <a class='btn btn-outline-danger' href='Nuevo-Registro.php'>Registrar</a>
                        </div>
                        ";
                    } else {
                        echo "
                        <div class='container-fluid'>
                            <a class='btn btn-primary' href='historial.php'>Historial</a>
                            <a class='btn btn-outline-danger' href='cierre-sesion.php?close=yes'>Salir</a>
                        </div>
                        ";
                    }
                    ?>
                </form>
            </div>
        </div>
    </nav>
    <section class="container-fluid py-3">
    <h1 class="login-tittle">Registro de ventas.</h1>
    <table class="table table-danger table-striped">
        <thead>
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Libro</th>
                <th scope="col">Fecha de venta</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Usuario</th>
            </tr>
        </thead>
    <?php
    $sql = "SELECT ventas.sellCode, ventas.dateBuy, ventas.amountSell, ventas.precio,ventas.isbnBook AS isbnBook, user.email AS user, book.tittle AS tittle 
    FROM ventas, user, book WHERE ventas.idUsuario = user.id AND ventas.isbnBook = book.isbn";
    $res = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($res)) {
        ?>
                    <tbody class="table-light">
                    <tr>
        <?php
                    echo "
                        <td><a href='book-view.php?code=".$row['sellCode']."&isbn=".$row['isbnBook']."'> ".$row['sellCode']."</a></th>
                        <td>".$row['tittle']."</td>
                        <td>".$row['dateBuy']."</td>
                        <td>".$row['amountSell']."</td>
                        <td>".$row['precio']."</td>
                        <td>".$row['user']."</td>
                        ";
        }
        ?>
                    </tr>
                    </tbody>
        </table>
    </section>
</body>
</html>