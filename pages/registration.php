<?php
    require '../configs/db_connection.php';
    if (!empty($_SESSION["id"])) {
        header("Location: ../index.php");
    }
    else {
        if (isset($_POST["submit"])) {
            $name = $_POST["name"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirmPassword"];
            $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
            if (mysqli_num_rows($duplicate) > 0) {
                echo "<script> alert('Username or Email Has Already Taken'); </script>";
            }
            else {
                if ($password == $confirmPassword) {
                    $query = "INSERT INTO users VALUES ('','$name','$username','$email','$password')";
                    mysqli_query($conn, $query);
                    echo "<script> alert('Registration Successful'); </script>";
                }
                else{
                    echo "<script> alert('Password Does Not Match'); </script>";
                }
            }
        }
    } 
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Registration</title>
    </head>
    <body>
        <h2>Registration</h2>
        <form class="" action="" method="post" autocomplete="off">
            <label for="name">Name : </label>
            <input type="text" name="name" id = "name" required value=""> 
            <br>
            <label for="username">Username : </label>
            <input type="text" name="username" id = "username" required value=""> 
            <br>
            <label for="email">Email : </label>
            <input type="email" name="email" id = "email" required value=""> 
            <br>
            <label for="password">Password : </label>
            <input type="password" name="password" id = "password" required value=""> 
            <br>
            <label for="confirmPassword">Confirm Password : </label>
            <input type="password" name="confirmPassword" id = "confirmPassword" required value=""> 
            <br>
            <button type="submit" name="submit">Register</button>
        </form>
        <br>
        <a href="login.php">Login</a>
    </body>
</html>
