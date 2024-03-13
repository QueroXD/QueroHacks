<?php
    require "../lib/consultas.php";
    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit(0);
    }else{
        $username = $_SESSION['username'];
        loginSucces($username);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>QueroHacks - home</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/common.css" />
    <link rel="icon" type="image/x-icon" href="../img/QueroHacks_Icon.png" />
  </head>
<body>
    <div id="container-form">
        <h1>Welcome, <?php echo $username; ?>!</h1>
        <form action="logout.php" method="post">
            <input type="submit" value="LOG OUT" class="button">
        </form>
    </div>
</body>
</html>
