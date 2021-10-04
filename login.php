<?php

include 'config1.php';

session_start();

error_reporting(0);
if(isset($_SESSION["usernamemail"])) {
 header("location:welcome.php");
}

if(isset($_POST["submit"])) {   
 if(!empty($_POST["usernamemail"]) && !empty($_POST["password"])) {
  $name = mysqli_real_escape_string($conn, $_POST["usernamemail"]);
  $password = md5(mysqli_real_escape_string($conn, $_POST["password"]));
  $sql = "SELECT * FROM user WHERE usernamemail = '" . $name . "' and password = '" . $password . "'";  
  $result = mysqli_query($conn,$sql);
  if($user) {  
   if(empty($_POST["remember"])) {
    $time = time() - (10 * 365 * 24 * 60 * 60);
    setcookie ("member_login",$name,time());
    if ($result->num_rows > 0) {
       $row = mysqli_fetch_assoc($result);
       $_SESSION['usernamemail'] = $row['usernamemail'];
       header("Location: welcome.php");

    }
  }
}  
  $user = mysqli_fetch_array($result);  
  if($user) {  
   if(!empty($_POST["remember"])) {  
    setcookie ("member_login",$name,time()+ (10 * 365 * 24 * 60 * 60));  
    $_SESSION["usernamemail"] = $name;
   }  
   else {  
    if(isset($_COOKIE["member_login"]))   
    {  
     setcookie ("member_login","");  
    }   
   }  
   header("location:welcome.php"); 
  }  
  else {  
   $message = "Invalid Login";  
  } 
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
<title>Login Form Mahasiswa</title>
</head>
<body>
	<div class="container">
    <form action="" method="POST" class ="login-email">
        <p class="login-text">Login</p>
        <div class="input-group">
            <input type="username" placeholder="Username or Email" name="usernamemail" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" required>
        </div>
        <div class="input-group">
            <input type="password" placeholder="Password" name="password" required>
        </div>
        <div class="input-group2">
            <input type="checkbox" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> /> 
            <label class="teks" for="ingataku"> Remember Username</label>
        </div>
        <div class="input-group">
            <button name="submit" class="btn">Login</button>
        </div>
        <p class="login-register-text">Don't have an account?<a href="registrasi.php"> Register Here</p>
    </div>
    </form>
</body>		