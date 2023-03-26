<?php
    require '../configs/db_connection.php';
    if (!empty($_SESSION["id"])) {
        $id = $_SESSION["id"];
        $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
        $row = mysqli_fetch_assoc($result);

        if (isset($_POST["submit"])) {
            $fileName = $_FILES["file"]["name"];
            $fileTmpName = $_FILES["file"]["tmp_name"];
            $fileSize = $_FILES["file"]["size"];
            $fileError = $_FILES["file"]["error"];
            $fileType = $_FILES["file"]["type"];

            $folderDestination = "../files/external/".$id;
            $fileDestination = "../files/external/".$id."/".$fileName;
            if (!file_exists($folderDestination)) {
                mkdir($folderDestination, 0777, true);
            }
            move_uploaded_file($fileTmpName, $fileDestination);

            $result = $collection->insertOne( ['fileName' => $fileName, 'userId' => $id] );
        }
    }
    else {
        header("Location: ../index.php");
    } 
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Home</title>
    </head>
    <body>
        <a href="logout.php">Logout</a>
        <h1>Welcome <?php echo $row["name"]; ?></h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="uploadFile">Upload File : </label>
            <br>
            <input type="file" name="file" id="file">
            <br>
            <button type="submit" name="submit">Upload</button>
        </form>
        <h2>My Files: </h2>
        <table class="table">
            <tr>
                <th scope="col">Filename</th>
            </tr>
            <?php
                $files = $collection->find(array('userId' => $id));
                foreach ($files as $fl) {
                    echo "<tr>";
                    echo "<td>".$fl->fileName."</td>";
                    echo "<td>";
                        echo "<a href = 'download.php?id=".$fl->_id."&filePath=../files/external/".$id."/".$fl->fileName."'>DOWNLOAD</a>";
                    echo "<td>";
                    echo "<td>";
                        echo "<a href = 'delete.php?id=".$fl->_id."&filePath=../files/external/".$id."/".$fl->fileName."'>DELETE</a>";
                    echo "</td>";
                    echo "</tr>";
                    
                }
            ?>
        </table>
        
    </body>
</html>