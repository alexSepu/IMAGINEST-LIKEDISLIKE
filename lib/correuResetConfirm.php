<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';
$mail = new PHPMailer();
$mail->IsSMTP();
//Configuració del servidor de Correu
//Modificar a 0 per eliminar msg error
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;

//Credencials del compte GMAIL
$mail->Username = 'asepulveda2021@educem.net';
$mail->Password = '';

//Dades del correu electrònic
$mail->SetFrom('asepulveda2021@educem.net','Reset password confirm');
$mail->Subject = 'Reset password confirm';
$mail->MsgHTML("<h3>Congratulations, you reset your password</h3>");
//$mail->addAttachment("fitxer.pdf");
//Destinatari
$address = $usermail;
$mail->AddAddress($address, 'Reset password confirm');

//Enviament
$result = $mail->Send();
if (!$result) {
    echo 'Error: ' . $mail->ErrorInfo;
}
