<?php

include 'config1.php';

error_reporting(0);

session_start();

if (isset($_SESSION['usernamemail'])) {
    header("Location: login.php");
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $usernamemail = $_POST['usernamemail'];
    $password = md5($_POST['password']);
    $password2 = md5($_POST['password2']);
    if ($password == $password2) {
        $sql = "SELECT * FROM user WHERE usernamemail='$usernamemail'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO user (name, usernamemail, password)
                    VALUES ('$name', '$usernamemail', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
               echo "<script>alert('Congratulation! Registration Completed.')</script>";
                $name = "";
                $usernamemail = "";
                $_POST['password'] = "";
                $_POST['password2'] = "";
            } 
            else {
                echo "<script> alert('Oopps! Someting Went Wrong') </script>";
            }
        }
        else {
            echo "<script>alert('Woops! Email Already Exists.')</script>";
        }
    }
    else {
        echo "<script> alert('Password Not Matched!') </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="with=device-width, initial scale=1.0">
  <title>Pemweb Website</title>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Registrasi Form Mahasiswa</title>
</head>
<body>
	<div class="container">
    <form action="" method="POST" class ="login-email">
        <p class="login-text">Register</p>
        <div class="input-group">
            <input type="name" placeholder="Name" name="name" value="<?php echo $name; ?>" required>
        </div>
        <div class="input-group">
            <input type="usernamemail" placeholder="Username or Email" name="usernamemail" value="<?php echo $usernamemail; ?>" required>
        </div>
        <div class="input-group">
            <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
        </div>
        <div class="input-group">
            <input type="password" placeholder="Confirm Password" name="password2" value="<?php echo $_POST['password2']; ?>" required>
        </div>
        <div class="input-group">
            <button name="submit" class="btn">Register</button>
        </div>
        <p class="login-register-text">Already have an account?<a href="index.php"> Login Here</p>
    </div>
    </form>
</body>		