<?php
  require "../lib/consultas.php";

  $useradd = false;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['passwd'];

    if(checkUser($username, $password)==1){
      session_start();
      $_SESSION['username'] = $username;
      header("Location: home.php");
      exit(0);
    }else{
      $respuesta = '<h2 id="incorrect">Credentials are incorrect</h2>';
      $useradd = true;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>QueroHacks - Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/common.css" />
    <link rel="icon" type="image/x-icon" href="../img/QueroHacks_Icon.png" />
  </head>
  <body>
    <main>
      <div id="container-form">
        <img src="../img/QueroHacks_Logo.jpg" alt="Logo ClassWave" id="iconoEmpresa"/>
        <?php if($useradd == true){echo $respuesta;}?>
        <form method="post">
          <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required />
          </div>
          <div>
            <label for="password">Password:</label>
            <input type="password" id="passwd" name="passwd" required />
          </div>
          <input type="submit" value="SUBMIT" class="button" />
        </form>
        <div>
          <footer> New user? <a href="register.php">Sign Up</a></footer>
        </div>
      </div>
    </main>
  </body>
</html>
