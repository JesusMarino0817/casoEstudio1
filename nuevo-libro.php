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
<body>
<?php $type = isset($_SESSION['type']) && $_SESSION['type'] == 1 ? "1" : "2";?>
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
<section class="container-fluid mt-5 justify-content-center" style="padding: 1em;"">
    <div class="register-section">
        <h1 class="tittle-register px-1">Registro de Libro.</h1>
        <form style="padding: 1rem;" action="recibe-libro.php" method="post" enctype="multipart/form-data"/>
            <div class="mb-3 container-fluid">
                <label for="tittle" class="form-label">Titulo: </label>
                <input type="text" name="tittle" id="tittle" class="form-control">
            </div>
            <div class="mb-3 container-fluid">
                <label for="isbn">ISBN: </label>
                <input type="text" name="isbn" id="isbn" class="form-control">
            </div>
            <div class="mb-3 container-fluid">
                <label for="description">Descripción: </label>
                <textarea class='form-control' id="description" name='description' type='text' cols='50' rows='7'></textarea>
            </div>
            <div class="mb-3 container-fluid">
                <label for="autor">Autor: </label>
                <input type="text" name="autor" id="autor" class="form-control">
            </div>
            <div class="mb-3 container-fluid">
                <label for="genre">Genero: </label>
                <input type="text" name="genre" id="genre" class="form-control">
            </div>
            <div class="mb-3 container-fluid">
                <label for="editorial">Editorial: </label>
                <input type="text" name="editorial" id="editorial" class="form-control">
            </div>
            <div class="mb-3 container-fluid">
                <label for="amount">Cantidad: </label>
                <input type="text" name="amount" id="amount" class="form-control">
            </div>
            <div class="mb-3 container-fluid">
                <label for="price">Precio: </label>
                <input type="text" name="price" id="price" class="form-control">
            </div>
            <div class="mb-3 container-fluid">
                <label for="image">Imagen: </label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary button-register">Agregar</button>
        </form>
    </div>
</section>
</body>
</html>