<?php
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    include("conexion.php");
    $sql = "SELECT * FROM user where email ='$email' and password = '$pass' ";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION["last_name1"] = $row["last_name1"];
                $_SESSION['last_name2'] = $row["last_name2"];
                $_SESSION['email'] = $row["email"];
                $_SESSION['type'] = $row["type"];
                if ($result->num_rows > 0)
                    header("Location: index.php");
                }
            }else{
                echo '<script language="javascript">
                alert("Los datos son incorrectos vuelve a intentarlo");
                window.location.href="index.php";
                </script>';
        }