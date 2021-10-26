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
<?php 
session_start();
$type = isset($_SESSION['type']) && $_SESSION['type'] == 1 ? "1" : "2";
?>
<body style="background: #000000;">
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
    <section class="container-fluid">
        <div class="row container-fluid">
        <?php 
        $isbn = $_GET["isbn"];
        include("conexion.php"); 
        $query = "SELECT * FROM book WHERE isbn = '".$isbn."'";
        $res = mysqli_query($conn, $query);
        while($row = $res->fetch_assoc()) {
            ?>
            <div class="book-section my-3 my-sm-3 my-md-3 my-lg-3 my-xl-3 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">
                <div class="d-flex align-self-start row">
                    <div class="col-12 col-sm-12 col-md-4 py-1">
                        <?php echo "<img src='images/".$row['imagen']."' class='w-100 p-2 book-img d-block mx-auto d-md-inline'>"; ?>
                    </div>
                    <div class="p-3 col-md-8">
                    <?php 
                    if(isset($_GET['edit'])) {
                        $_SESSION['isbn'] = $isbn;
                        echo "<form action='edit.php' method='post'>
                            <label for='tittle'>Titulo</label>
                            <input class='form-control' name='tittle' type='text' value='".$row['tittle']."'>
                            <label for='description'>Descripción</label>
                            <textarea class='form-control' name='description' type='text' cols='50' rows='7'> ".$row['description']."</textarea>
                            <label for='autor'>Autor</label>
                            <input class='form-control' name='autor' type='text' value='".$row['autor']."'>
                            <label for='genre'>Genero</label>
                            <input class='form-control' name='genre' type='text' value='".$row['genre']."'>
                            <label for='editorial'>Editorial</label>
                            <input class='form-control' name='editorial' type='text' value='".$row['editorial']."'>
                            <label for='amount'>Cantidad</label>
                            <input class='form-control' name='amount' type='text' value='".$row['amount']."'>
                            <label for='price'>Precio</label>
                            <input class='form-control' name='price' type='text' value='".$row['price']."'>
                            <button class='btn btn-primary my-2' type='submit'>Actualizar</button>
                        </form>";
                    } else {
                    echo "
                        <h1 class='book-tittle d-md-inline'> ".$row['tittle']."</h1>
                        <p class='search-paragraph'> ".$row['description']."</p>
                        <p class='search-paragraph'><b>Autor:</b> ".$row['autor']."</p>
                        <p class='search-paragraph'><b>Genero:</b> ".$row['genre']."</p>
                        <p class='search-paragraph'><b>Editorial: </b> ".$row['editorial']."</p>
                        <p class='search-paragraph'><b>Cantidad: </b> ".$row['amount']."</p>
                        <p class='search-paragraph'><b>Precio: </b> ".$row['price']."</p>
                        <a href='pago.php?isbn=$isbn' class='btn btn-primary d-flex float-end m-2' role='button'>Comprar</a>
                        ";
                    }
                        $_SESSION['price'] = $row['price'];
        } ?>
                    </div>
                </div>
            </div>
            <div style="background: #842029;" class="my-3 my-sm-3 my-md-3 my-lg-3 my-xl-3 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 row">
            <h1 class="book-tittle-recommend py-4">Tambien recomendamos...</h1>
                <?php
                $query = "SELECT * FROM book WHERE genre = (SELECT genre FROM book WHERE isbn = '$isbn') AND isbn != '$isbn' ORDER BY rand()
                LIMIT 3";
                $res = mysqli_query($conn, $query);
                while($row = $res->fetch_assoc()) {
                    ?>
                    <div class="col-12">
                        <div class="book-recommend">
                            <div class="d-flex row p-2">
                                <div class="col-4">
                                    <?php echo "<img src='images/".$row['imagen']."' class='w-100'>";?>
                                </div>
                                <div class="col-8">
                                <?php 
                                echo "
                                    <h2 class='book-tittle-recommend-2'>".$row['tittle']."</h2>
                                    <p class='book-tittle-recommend-3'>De ".$row['autor']."</p>
                                    <p class='book-description'>".$row['description']."</p>
                                    <a class='btn btn-primary float-end'>Ver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
                }
                ?>
        </div>
    </section>  
</body>
</html>