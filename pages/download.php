<?php
    require '../configs/db_connection.php';
    if (!empty($_SESSION["id"])) {
        if (isset($_GET['id'])) {
            header("Pragma:public");
            header("Expired:0");
            header("Cache-Control:must-revalidate");
            header("Content-Control:public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition:attachment; filename=\"".basename($_GET['filePath'])."\"");
            header("Content-Transfer-Encoding:binary");
            header("Content-Length:".filesize($_GET['filePath']));
            flush();
            readfile($_GET['filePath']);
            header("Location: ../index.php");
        }
    }
    else {
        header("Location: ../index.php");
    }
?>