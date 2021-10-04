<?php 

session_start();
if(!isset($_SESSION['usernamemail'])){
    header("location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Home Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="home">
    <h1>Welcome <?php echo $_SESSION['usernamemail']; ?> </h1>
        <div class="input-group">
            <a href="logout.php"><button type="button" class="btn btn-danger">Logout</button></a>
        </div>
    </div>

</body>
</html>