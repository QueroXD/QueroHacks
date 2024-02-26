<?php
    require "../lib/registerDBuser.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/register.css">
    <link rel="icon" type="image/x-icon" href="">
</head>
<body>
    <main>
        <div id="container-form">
            <img src="../img/QueroHacks_Logo.jpg" alt="Logo ClassWave" id="iconoEmpresa">
            <h1>Signup</h1>
            <form method="post">
                <div>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div>
                    <label for="mail">Email:</label>
                    <input type="mail" name="mail" id="mail" required>
                </div>
                <div>
                    <label for="fName">First Name:</label>
                    <input type="text" name="fName" id="fName" required>
                </div>
                <div>
                    <label for="lName">Last Name:</label>
                    <input type="text" name="lName" id="lName" required>
                </div>
                <div>
                    <label for="passwd">Password:</label>
                    <input type="password" name="passwd" id="passwd" required>
                </div>
                <div>
                    <label for="username">Verify Password:</label>
                    <input type="password" name="verifyedpasswd" id="verifyedpasswd" required>
                </div>
                <div>
                    <label for="agree">
                        <input type="checkbox" name="agree" id="agree" value="yes"/> I agree
                        with the <a href="#" title="term of services">term of services</a>
                    </label>
                </div>
                <input type="submit" value="REGISTER" id="button">
                <footer>Already a member? <a href="login.php">Login here</a></footer>
            </form>
        </div>
    </main>
</body>
</html>