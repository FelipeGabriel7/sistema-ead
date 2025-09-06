<?php

use PHPMailer\PHPMailer\PHPMailer;

function send_to_email($destinatario, $assunto, $msgEmail)
{
        require("./vendor/autoload.php");
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = false;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Password = 'qdqj fzjh udmy rbpy';
        $mail->Username = 'felipegabfd@gmail.com';
        $mail->setFrom('felipegabfd@gmail.com', 'Recuperação de Senha');
        $mail->AddAddress($destinatario);
        $mail->Subject = $assunto;
        $mail->isHTML(true);
        $mail->Body = $msgEmail;

        if ($mail->send()) return true;
        return false;
}
