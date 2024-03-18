<?php
    // option = 1 --> register mode
    // option = 2 --> login mode

    require "../lib/consultas.php";

    $useradd = false;

    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $username = $_POST['username'];
        $mail = $_POST['mail'];
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $password = $_POST['passwd'];
        $verifiedPassword = $_POST['verifyedpasswd'];

        if (checkUser($username, $password, 1)==1) {
            $respuesta = '<h2 id="incorrect">The user already exists</h2>';
        } else if(checkUser($username, $password, 1)==0) {
            insertUser($username, $mail, $fName, $lName, $password);
            $respuesta = '<h2 id="correct">User added succesfully</h2>';
        }
        $useradd = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>QueroHacks - register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="icon" type="image/x-icon" href="../img/QueroHacks_Icon.png">
</head>
<body>
    <main>
        <div id="container-form">
            <img src="../img/QueroHacks_Logo.jpg" alt="Logo" id="iconoEmpresa">
            <?php if($useradd == true){echo $respuesta;}?>
            <form method="post">
                <div id="parameters">
                    <div class="parametersContainer">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div class="parametersContainer">
                        <label for="mail">Email:</label>
                        <input type="mail" name="mail" id="mail" required>
                    </div>
                    <div class="parametersContainer">
                        <label for="fName">First Name:</label>
                        <input type="text" name="fName" id="fName" required>
                    </div>
                    <div class="parametersContainer">
                        <label for="lName">Last Name:</label>
                        <input type="text" name="lName" id="lName" required>
                    </div>
                    <div class="parametersContainer">
                        <label for="passwd">Password:</label>
                        <input type="password" name="passwd" id="passwd" required>
                    </div>
                    <div class="parametersContainer">
                        <label for="username">Verify Password:</label>
                        <input type="password" name="verifyedpasswd" id="verifyedpasswd" required>
                    </div>
                </div>
                <div class="terms">
                    <label for="agree" class="agree"></label>
                    <input type="checkbox" name="agree" id="agree" value="yes"/>
                    <p>I agree with the <a href="#" title="term of services"> term of services</a></p>
                </div>
                <input type="submit" value="REGISTER" class="button">
                <footer>Already a member? <a href="index.php">Login here</a></footer>
            </form>
        </div>
    </main>
</body>
</html>