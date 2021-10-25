<?php
session_start();
if(isset($_GET['close'])) {
    $_SESSION['id'] = NULL;
    $_SESSION['name'] = NULL;
    $_SESSION["last_name1"] = NULL;
    $_SESSION['last_name2'] = NULL;
    $_SESSION['email'] = $NULL;
    $_SESSION['type'] = $NULL;
    unset($_SESSION['id']);
    unset($_SESSION['name']);
    unset($_SESSION['last_name1']);
    unset($_SESSION['last_name2']);
    unset($_SESSION['email']);
    unset($_SESSION['type']);
    header('Location: index.php');
}