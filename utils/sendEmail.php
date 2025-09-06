<?php

use PHPMailer\PHPMailer\PHPMailer;

function send_to_email($destinatario, $assunto, $msgEmail)
{
        require("./vendor/autoload.php");
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = false;
        $mail->Host = '';
        $mail->Port = '';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Password = '';
        $mail->Username = 'user@mail.com';
        $mail->setFrom('user@mail.com', 'Recuperação de Senha');
        $mail->AddAddress($destinatario);
        $mail->Subject = $assunto;
        $mail->isHTML(true);
        $mail->Body = $msgEmail;

        if ($mail->send()) return true;
        return false;
}
