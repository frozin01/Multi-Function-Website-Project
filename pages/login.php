<?php
    require '../configs/db_connection.php';
    if (!empty($_SESSION["id"])) {
        header("Location: ../index.php");
    }
    else {
        if (isset($_POST["submit"])) {
            $usernameEmail = $_POST["usernameEmail"];
            $password = $_POST["password"];
            $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$usernameEmail' OR email = '$usernameEmail'");
            $row = mysqli_fetch_assoc($result);
            if (mysqli_num_rows($result) > 0) {
                if ($password == $row['password']) {
                    $_SESSION["login"] = true;
                    $_SESSION["id"] = $row["id"];
                    header("Location: ../index.php");
                } 
                else {
                    echo "<script> alert('Wrong Password'); </script>";
                }
            }
            else {
                echo "<script> alert('User Not Registered'); </script>";
            }
        }
    } 
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
    </head>
    <body>
        <h2>Login</h2>
        <form class="" action="" method="post" autocomplete="off">
            <label for="usernameEmail">Username or Email : </label>
            <input type="text" name="usernameEmail" id="usernameEmail" required value=""> 
            <br>
            <label for="password">Password : </label>
            <input type="password" name="password" id="password" required value=""> 
            <br>
            <button type="submit" name="submit">Login</button>
        </form>
        <br>
        <a href="registration.php">Registration</a>
    </body>
</html>
