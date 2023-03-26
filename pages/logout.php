<?php
    require '../configs/db_connection.php';
    if (!empty($_SESSION["id"])) {
        $_SESSION = [];
        session_unset();
        session_destroy();
        header("Location: ../index.php");
    }
    else {
        header("Location: ../index.php");
    }
?>