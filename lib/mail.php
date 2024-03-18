<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require 'vendor/autoload.php';

    $mail = new PHPMailer();
    $mail -> IsSMTP(); 

    // Configuracion del servidor de correo
    // Modificar a 0 para eliminar msg error

    $mail->SMTPDebug = 2;                                     // Enable verbose debug output                               //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                 // Enable SMTP authentication
    $mail->Username   = 'alvaro.queroa@educem.net';           // SMTP username
    $mail->Password   = 'xbeu zmcw jksx usof';                // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          // Enable implicit TLS encryption
    $mail->Port       = 465;                                  // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Datos del correo electronico:
    $mail->SetFrom('alvaro.queroa@educem.net','no-reply');  // Quien lo envia
    // $mail->addCC($_POST["cc"]);                           // En copia
    $mail->Subject = "Welcome to QueroHacks";                               // Asunto

    $mail->isHTML(true);                                        // Metes HTML
    $mail->Body    = '
        <h1>Welcome to QueroHacks</h1>
        <p>To activate your account, please click on the following link:</p>
        <a href="https://querohacks.com/activate-account">Activate Account</a>
        <p>Thank you for registering.</p>';   // Contenido del correo
    $mail->addAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);           // Archivo

    // Datos del destinatarioº
    $address = $_POST["mail"];                              // A quien le llega
    $mail->AddAddress($address);                   // Nombre de quien le llega

    // Envio
    $result = $mail->Send();

    if(!$result){
        echo 'Error: ' . $mail->ErrorInfo;
    }else{
        echo "Correu enviat";
    }