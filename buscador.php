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
        <p class='search-body mx-3'>Resultado de busqueda sobre: <b> <?php echo $_POST['search'] ?></b></p>
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
                                <img src='images/".$row['image']."' class='search-images mx-2 my-3'>
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
                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v10.0" nonce="blmHCvYU"></script>
                        <p class="search-body">Siguenos en nuestras redes sociales para enterarte de las novedades en la tienda.</p>
                        <p class="search-body">Siguenos en Twitter</p>
                        <a href="https://twitter.com/bookzon?ref_src=twsrc%5Etfw"
                        class="twitter-follow-button mx-3" data-show-count="false">
                            Follow @bookzon</a>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        <p class="search-body my-2">Dale Like a nuestra pagina de facebook.</p>
                        <div class="fb-page m-3"
                            data-href="https://www.facebook.com/thebookzon"
                            data-tabs="timeline" data-width="" data-height=""
                            data-small-header="false" data-adapt-container-width="true"
                            data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="https://www.facebook.com/thebookzon" class="fb-xfbml-parse-ignore">
                                <a href="https://www.facebook.com/thebookzon">Bookzon</a></blockquote>
                        </div>
                    </div>
                    </div>
    </section>      
</body>
</html>