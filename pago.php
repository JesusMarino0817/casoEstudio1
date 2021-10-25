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
    <?php 
    $_SESSION['isbn'] = $_GET['isbn'];
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
    <?php
    include("conexion.php");
    $query = "SELECT * FROM paqueteria ORDER BY rand() LIMIT 1";
    $res = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($res)) {
        $_SESSION['paqueteria'] = $row['idDis'];
    }
    ?>
    <section class="container-fluid my-3">
        <div class="container-fluid payment py-3">
            <h1>Detalles de la compra.</h1>
            <form action="recibe-pago.php" method="post">
                <div class="row">
                    <div class="col-12 col-lg-6 col-xl-6">
                        <p class="payment-desc">Libro: El ultimo Pasajero de Manel Loureiro</p>
                        <p class="payment-desc">Precio: $100.00</p>
                        <label for="amount">Cantidad de libros: </label>
                        <input type="number" name="amount" id="num1" class="form-control" onkeypress="return event.charCode >= 48" min="1">
                        <label>Tipo de envio:</label>
                        <select name="deliver" id="deliver" class="form-select" id="deliver">
                            <option value="70">Estandar</option>
                            <option value="120">Rápido</option>
                        </select>
                        <label for="price">Precio: </label>
                        <input type="number" name="price" id="num2" class="form-control" disabled value="">
                        <p class="payment-anotation">El envio estandar tiene un precio de $70.00, el cual tiene una duración maxima de entrega de 2
                            semanas, el envio rapido tiene un precio de $120.00, el cual tiene una duración maxima de
                            entrega de 2 dias.</p>
                    </div>
                    <div class="col-12 col-xl-6 col-lg-6 p-2 p-lg-1 p-xl-1">
                        <label>Nombre del titular:</label>
                        <input type="text" class="form-control" style="text-transform: uppercase">
                        <label>Numero de tarjeta:</label>
                        <input type="text" class="form-control" id="target" maxlength="16">
                        <label>Fecha de expericación:</label>
                        <div class="input-group">
                            <input type="text" placeholder="Mes" id="month" class="form-control" maxlength="2">
                            <input type="text" placeholder="Año" id="year" class="form-control" maxlength="2">
                        </div>
                        <label>CVV</label>
                        <input type="text" placeholder="3 digitos" id="cvv" class="form-control" maxlength="3">
                    </div>
                </div>
                <button class="btn btn-primary w-100">Pagar</button>
            </form>
        </div>
    </section>
    <script>
        let num1 = document.getElementById("num1");
        let num2 = document.getElementById("num2");
        let num3 = document.getElementById("deliver");
        num1.addEventListener("change", () => {
            num2.value = parseFloat(num1.value) * 100 + parseFloat(num3.value);
        })
        num3.addEventListener("change", () => {
            num2.value = parseFloat(num1.value) * 100 + parseFloat(num3.value);
        })

        document.getElementById("target").addEventListener("input", (e) => {
            let value = e.target.value;
            e.target.value = value.replace(/[^A-Z\d-]/g, "");
        })
        document.getElementById("month").addEventListener("input", (e) => {
            let value = e.target.value;
            e.target.value = value.replace(/[^A-Z\d-]/g, "");
        })
        document.getElementById("year").addEventListener("input", (e) => {
            let value = e.target.value;
            e.target.value = value.replace(/[^A-Z\d-]/g, "");
        })
        document.getElementById("cvv").addEventListener("input", (e) => {
            let value = e.target.value;
            e.target.value = value.replace(/[^A-Z\d-]/g, "");
        })
    </script>
</body>
</html>