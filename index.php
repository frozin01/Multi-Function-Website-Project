<?php
    require 'configs/db_connection.php';
    if (!empty($_SESSION["id"])) {
        header("Location: pages/home.php");
    }
    else {
        header("Location: pages/login.php");
    }
?>