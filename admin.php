<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
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
    <section class="container-fluid px-4">
    <div class="container-fluid py-4">
        <a href="nuevo-libro.php" class="btn btn-primary">Nuevo Libro</a>
        <a href="ventas.php" class="btn btn-outline-danger">Ver Ventas</a>
        <p class="book-tittle-recommend" style="font-size: 45px !important;">Todos los libros disponibles.</p>
    </div>
    <div class="row div-book p-3">
    <?php
        session_start();
        include("conexion.php");
        $sql = "SELECT * FROM book WHERE log_eliminacion = 'no'";
        $res = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($res)) {
            echo "
            <div class='col-2 p-2'>
                <img src='images/".$row['image']."' class='w-100'>
            </div>
            <div class='col-10'>
                <h1>ISBN: ".$row['isbn']." - ".$row['tittle']."</h1>
                <p> ".$row['description']."</p>
                <p>De: ".$row['autor']."</p>
                <p>Cantidad: ".$row['amount']."</p>
                <form id='delete' action='eliminar.php' method='post'>
                <input type='hidden' name='isbn' value='".$row['isbn']."'>
                <button type='submit' class='btn btn-danger'>Eliminar</button>
            </form>
            </div>";
        }
        ?>
        </div>
    </section>
    <?php
        session_start();
        include("conexion.php");
        $sql = "SELECT * FROM book WHERE log_eliminacion = 'no'";
        $res = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($res)) {
            echo "<a href='libro.php?isbn=".$row['isbn']."&edit=yes'>".$row['isbn']."</a>";
            echo "<p>".$row['tittle']."</p>";
            echo "
            <form id='delete' action='eliminar.php' method='post'>
                <input type='hidden' name='isbn' value='".$row['isbn']."'>
                <button type='submit'>Eliminar</button>
            </form>
            ";
        }
    ?>
    <script>
    (function() {
        let link = document.getElementById('delete');
        link.addEventListener('submit', function(event) {
            if(!confirm('¿Esta seguro de eliminar este elemento?')) {
                event.preventDefault();
            }
        },false);
    })();
    </script>
</body>
</html>