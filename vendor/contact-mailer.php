<?php
$nombre = htmlspecialchars($_POST['n'],ENT_QUOTES,'UTF-8');
$telefono = htmlspecialchars($_POST['t'],ENT_QUOTES,'UTF-8');
$email = htmlspecialchars($_POST['e'],ENT_QUOTES,'UTF-8');
$mensaje = htmlspecialchars($_POST['m'],ENT_QUOTES,'UTF-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    $mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
	);

    //Server settings
    $mail->SMTPDebug = 2;                      // Enable verbose debug output
    //$mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'backupcodesh@gmail.com';                     // SMTP username
    $mail->Password   = 'Heredero960815';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       =  465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('backupcodesh@gmail.com', ''.utf8_decode('Solicitación ').'de Servicios');
    $mail->addAddress($email, $nombre);
    $mail->addCC('backupcodesh@gmail.com');

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $nombre.' requiere mís servicios';
    //$mail->Body    = 'Gracias por enviar tu email <b>Listocho!</b>';
    $mail->Body = "                 
                    <h4 style='text-align: center;padding: 25px 15px;background-color: #0c6c9e;color: #FFFFFF;font-size:16px;width:90%;border-radius: 10px;'>¡Hola! Tienes una nueva consulta de su sitio web.</h4><br><br>
                    <strong>Email: </strong>" . $nombre . "<br>
                    <strong>Email: </strong>" . $telefono . "<br>
                    <strong>Email: </strong>" . $email . "<br>
                    <strong>Mensaje: </strong><br><br><div style='background-color: #EDEFF2;padding:30px 15px;border-radius:10px;min-height:50px;width:90%;'>" . utf8_decode($mensaje) . "</div><br>
                    ";

    $mail->send();
    //echo 'Mensaje Enviado';
    echo 1;
} catch (Exception $e) {
    //echo "No se pudo enviar el email: {$mail->ErrorInfo}";
    echo 0;
}