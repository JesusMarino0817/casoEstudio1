<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda</title>
    <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,500;1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
</head>
<?php session_start();
$type = isset($_SESSION['type']) && $_SESSION['type'] == 1 ? "1" : "2";
?>
<body style="background: #000000">
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
    <?php
        include("conexion.php");
        $palabra = explode(" ", $_POST['search']);
        $query ="SELECT * FROM book WHERE log_eliminacion = 'no' AND (tittle like '%" . $palabra[0] . "%' OR description like '%" . $palabra[0] . "%')";
        for($i = 1; $i < count($palabra); $i++) {
            if(!empty($palabra[$i])) {
                $query .= " OR description like '%" . $palabra[$i] . "%'";
            }
        }
        $res = $conn->query($query);
    ?>   
    <section class="container-fluid my-3">
        <p class='search-body mx-3'>Resultado de busqueda de: <b> <?php echo $_POST['search'] ?></b></p>
        <?php
            if(mysqli_num_rows($res) > 0) {
                $cont = 0;
                echo "<p class='search-body mx-3'>Numero de resultados: ".mysqli_num_rows($res)."</p> <br>";
                echo "<div class='row p-1 mx-1'>
                    <div class='col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 search-content p-4'>";
                while($row = $res->fetch_assoc()) {
                    $cont++;
                    $isbn = $row['isbn'];
                    echo "<div class='d-flex align-self-start'>
                            <div>
                                <img src='images/".$row['imagen']."' class='search-images mx-2 my-3'>
                            </div>
                            <div class='mx-2'>
                                <h1 class='search-tittle py-3'>".$row['tittle']."</h1>
                                <p class='search-paragraph'>".$row['description']."</p>
                                <p class='search-paragraph'><b>Autor: </b>".$row['autor']."</p>
                                <p class='search-paragraph'><b>Editorial: </b>".$row['editorial']."</p>
                                <a href='libro.php?isbn=".$row['isbn']."' class='btn btn-primary d-flex float-end m2' role='button'>Ver más</a>
                            </div>
                           </div>";
                }
            }
        ?>
                    </div>
                    <div class="p-3 col-xl-4">
                        <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous" src=https://connect.facebook.net/en_US/sdk.js" nonce="blmHCvYU"></script>
                        <p class="search-body">Siguenos en nuestras redes sociales con el creador de la página.</p>
                        <p class="search-body my-2">Sigue a nuestro creador.</p>
                        <svg viewBox="0 0 36 36" class="a8c37x1j ms05siws hwsy1cff b7h9ocf4" fill="url(#jsc_c_3)" height="40" width="40"><defs><linearGradient x1="50%" x2="50%" y1="97.0782153%" y2="0%" id="jsc_c_3"><stop offset="0%" stop-color="#0062E0"></stop><stop offset="100%" stop-color="#19AFFF"></stop></linearGradient></defs><path d="M15 35.8C6.5 34.3 0 26.9 0 18 0 8.1 8.1 0 18 0s18 8.1 18 18c0 8.9-6.5 16.3-15 17.8l-1-.8h-4l-1 .8z"></path><path class="p361ku9c" d="M25 23l.8-5H21v-3.5c0-1.4.5-2.5 2.7-2.5H26V7.4c-1.3-.2-2.7-.4-4-.4-4.1 0-7 2.5-7 7v4h-4.5v5H15v12.7c1 .2 2 .3 3 .3s2-.1 3-.3V23h4z"></path></svg>
                        <linearGradient x1="50%" x2="50%" y1="97.0782153%" y2="0%" id="jsc_c_3"><stop offset="0%" stop-color="#0062E0"></stop><stop offset="100%" stop-color="#19AFFF"></stop></linearGradient>
                        <path class="p361ku9c" d="M25 23l.8-5H21v-3.5c0-1.4.5-2.5 2.7-2.5H26V7.4c-1.3-.2-2.7-.4-4-.4-4.1 0-7 2.5-7 7v4h-4.5v5H15v12.7c1 .2 2 .3 3 .3s2-.1 3-.3V23h4z"></path>
                        <div class="fb-page m-3"
                            data-href="https://www.facebook.com/jesusmanuel.marinomendez"
                            data-tabs="timeline" data-width="" data-height=""
                            data-small-header="false" data-adapt-container-width="true"
                            data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="https://www.facebook.com/jesusmanuel.marinomendez" class="fb-xfbml-parse-ignore">
                                <a href="https://www.facebook.com/jesusmanuel.marinomendez">Jesus Marino</a></blockquote>
                        </div>
                    </div>
                    </div>
    </section>      
</body>
</html>