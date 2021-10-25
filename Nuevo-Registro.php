<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario</title>
    <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,500;1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
</head>
<body style="background: #000000;">
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-logo" href="index.php">Bookzon</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
                if($type == 1) {
                    echo "<a class='mx-2 btn btn-primary'>Administración</a>";
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
    <section class="container-fluid mt-5 d-xl-flex d-lg-flex" style="padding: 1em;">
        <div class="register-section col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <h1 class="tittle-register px-1">Registro de nuevo usuario.</h1>
            <p class="paragraph-register px-1">Cree su nueva cuenta para poder realizar compras en la pagina, administrar sus compras, y controlar el
                proceso de estas.</p>
            <form style="padding: 1rem;" action="recibe-user.php" method="post">
                <div class="mb-3 container-fluid">
                    <label for="name" class="form-label">Nombre: </label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="mb-3 container-fluid">
                    <label for="last1">Apellido Paterno</label>
                    <input type="text" name="last1" class="form-control">
                </div>
                <div class="mb-3 container-fluid">
                    <label for="last2">Apellido Materno</label>
                    <input type="text" name="last2" class="form-control">
                </div>
                <div class="mb-3 container-fluid">
                    <label for="email">Correo Electronico</label>
                    <input type="text" name="email" class="form-control">
                </div>
                <div class="mb-3 container-fluid">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary button-register">Registrarse</button>
            </form>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            <p class="text-register text-xl-center text-lg-center text-md-center text-sm-center text-center">Bookzon</p>
            <div class="fig" style="margin-left: 3em;"></div>
            <p class="content-text-register">En Bookzon, usted podra conseguir los mejores libros de la actualidad en los mejores precios, consiga
            libros de las principales editoriales del mundo y de todo tipo, consulte en todo momento como va su entrega
            y goce de sus libros favoritos.
            </p>
            <div class="row">
                <div class="col-4 d-flex justify-content-center">
                    <img src="images/Arco.jpg" class="p-2 editorials w-75" style="margin-left: 5em;">
                </div>
                <div class="col-4 d-flex justify-content-center">
                    <img src="images/juventud.png" class="p-2 editorials w-75 col-6" style="height: 60px; margin-top: 3em;">
                </div>
                <div class="col-4 d-flex justify-content-center">
                    <img src="images/Nirvana.png" class="p-2 editorials w-75 col-6" style="height: 110px; margin-top: 1em;">
                </div>
            </div>
            <div class="fig float-xl-end float-lg-end float-md-end float-sm-end float-end"></div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>