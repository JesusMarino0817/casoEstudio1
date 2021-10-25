<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles</title>
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
            <a class="navbar-logo" href="index.php">Bookzon</a>
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
    <section class="container-fluid">
        <div class="container-fluid p-3">
            <div class="book-view p-3 row book-view-text">
                <h1>Detalles del libro</h1>
                <?php
                $code = $_GET['code'];
                $isbn = $_GET['isbn'];
                $_SESSION['code'] = $code;
                $sql = "SELECT * FROM book WHERE isbn = '$isbn'";
                $res = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($res)) {
                ?>
                <div class="col-xl-3">
                    <?php echo "<img src='images/".$row['image']."' class='p-3 w-100'>";?>
                </div>
                <div class="col-xl-4 p-3">
                <?php
                echo "
                    <p><b>Nombre del libro: </b>".$row['tittle']."</p>
                    <p><b>Autor: </b>".$row['autor'].".</p>
                    <p><b>Descripción: </b>".$row['description']."</p>
                    <p><b>Editorial: </b>".$row['editorial'].".</p>
                    <p><b>Precio: </b>".$row['price']."</p>
                    ";
                }
                if($type == "1") {
                    echo "
                    <form action='status.php' method='post'>
                    <select name='status' id='status'  class='form-select'>
                        <option value='Enviando'>Enviado</option>
                        <option value='Hecho'>Hecho</option>
                        <option value='Estancado'>Estancado</option>
                    </select>
                    <button type='submit' class='btn btn-primary my-2 py-2'>Actualizar</button>
                    </form>
                    ";
                }
                ?>
                </div>
                <div class="col-xl-5 p-3">
                <?php
                $sql = "SELECT * FROM ventas WHERE sellCode = $code";
                $res = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($res)) {
                    $sql2 = "SELECT * FROM paqueteria WHERE idDis = '".$row['envioDist']."'";
                    $res2 = mysqli_query($conn, $sql2);
                    while($row2 = mysqli_fetch_assoc($res2)) {
                        echo "
                            <p><b>Cantidad solicitada: </b>".$row['amountSell']."</p>
                            <p><b>Fecha de venta: </b>".$row['dateBuy']."</p>
                            <p><b>Envio: </b>".$row['envio']."</p>
                            <p><b>Enviado por: </b>".$row2['nameDis']."</p>
                            <p><b>Estado del pedido: </b>".$row['status']."</p>
                            <p><b>Pago realizado: </b>".$row['precio']."</p>
                            ";
                    }
                }
                ?>
                </div>
            </div>
        </div>
    </section>
</body>
</html>