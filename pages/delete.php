<?php
    require '../configs/db_connection.php';
    if (!empty($_SESSION["id"])) {
        if (isset($_GET['id'])) {
            $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
            unlink($_GET['filePath']);
            header("Location: ../index.php");
        }
    }
    else {
        header("Location: ../index.php");
    }
?>