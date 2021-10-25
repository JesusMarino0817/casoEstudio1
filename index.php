<?php
    include("conexion.php");
?>
<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,500;1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
    <title>Tienda de libros</title>
</head>
<?php 
session_start();
$user = isset($_SESSION['email']) ? $_SESSION['name'] : "Usuario";
$type = isset($_SESSION['type']) && $_SESSION['type'] == 1 ? "1" : "2";
?>
<body style="background: #1a1e21;">
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
    <section class="head">
        <div class="row head-son">
        <?php
            $sql = "SELECT * FROM slider WHERE estado=1 ORDER BY orden";
            $stmt = mysqli_query($conn, $sql);
            $slides = mysqli_num_rows($stmt);
        ?>
            <div class="description col-xl-5">
                <img src="images/logo.jpg" class="mx-auto d-block" alt="Logo Bookzon">
                <p class="subtittle" style="text-align: center" id="welcome">¡Hola <span><?php $USER ?></span>!, te damos la bienvenida.</p>
            </div>
            <div id="carouselExampleCaptions" class="carousel slide col-xl-7" style="margin-left: auto;" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
                        for($i = 0; $i < $slides; $i++) {
                            $active = "active";
                            echo "<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to=".$i." class=".$active." ></button>";
                        }
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php
                        $active = "active";
                        while($row = mysqli_fetch_array($stmt)) {
                    ?>
                            <div class="carousel-item <?php echo $active;?>">
                                <img src="images/<?php echo $row['url_image'];?>" class="d-block w-100" alt="<?php echo $row['titulo'];?>" style="border-radius: 10px;" data-holder-rendered="true">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5><?php echo $row['titulo'] ?></h5>
                                    <p><?php echo $row['descripcion'] ?></p>
                                </div>
                            </div>
                    <?php
                            $active="";
                        }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div>
        <h1 class="p-4 top">Top 3 de ventas.</h1>
        <table class="table table-danger table-striped">
        <thead>
            <tr>
                <th scope="col">Libro</th>
                <th scope="col">Cantidades vendidas</th>
            </tr>
        </thead>
            <?php
            $sql = "SELECT SUM(ventas.amountSell) AS amount, book.tittle FROM ventas, book WHERE book.isbn = ventas.isbnBook GROUP BY tittle ORDER BY amount DESC LIMIT 3";
            $res = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($res)) {
                echo "
                <tbody class='table-light'>
                    <tr>
                        <td>".$row['tittle']."</th>
                        <td>".$row['amount']."</th>
                    </tr>
                </tbody>
                ";
            }
            ?>
        </table>
        </div>
    </div>

    <div class="container-fluid">
        <div class="main row container-fluid p-2">
            <div class="col-xl-4">
                <div class="d-inline-flex main-target-book w-100">
                    <img class="images-main" src="images/open-book.svg">
                    <p class="paragraph"> Una extensa cantidad de libros esperandote, crea una cuenta y empieza a ordenar.</p>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="d-inline-flex main-target-delivery w-100">
                    <img class="images-main" src="images/food-delivery.svg">
                    <p class="paragraph"> Envios a todo el país, no importa donde estes, ¡tu libro llegara!.</p>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="d-inline-flex main-target-payment w-100">
                    <img class="images-main" src="images/debit-card.svg">
                    <p class="paragraph"> Paga con tu método de cofianza, aceptamos tarjetas de credito y debito.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

</body>
</html>