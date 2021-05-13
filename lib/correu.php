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
$mail->Username = 'sepulvedagarciaalex@gmail.com';
$mail->Password = '';

//Dades del correu electrònic
$mail->SetFrom('asepulveda2021@educem.net','Verification account');
$mail->Subject = 'Verification account';
$mail->AddEmbeddedImage('img/LOGOI.png','logomail');
$mail->MsgHTML("<div style='width:100%;text-align:center;'>
            <h1> WELCOME TO IMAGINEST</h1>
            <img style='width:50%;height:50%' src='cid:logomail'/>
            <h5>Please, click the next link to verify your account <a href='$link'>Verify</a></h5>
</div>");
//$mail->addAttachment("fitxer.pdf");
//Destinatari
$address = $usermail;
$mail->AddAddress($address, 'Verify account');

//Enviament
$result = $mail->Send();
if (!$result) {
    echo 'Error: ' . $mail->ErrorInfo;
}
