<?php
    session_start();
    unset($_SESSION["iduser"]);
    unset($_SESSION["username"]);
    unset($_SESSION["email"]);
    header("location:index");
    exit();
?>