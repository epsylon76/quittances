<?php
function envoimail($from, $to, $subject, $message, $fichier, $nompiecejointe){
    //path to PHPMailer class
    require_once('./phpmailer/PHPMailerAutoload.php');



    $mail = new PHPMailer();
    $mail->CharSet = "UTF-8";
    $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP
    $mail->Host = 'smtp.office365.com'; // Spécifier le serveur SMTP
    $mail->SMTPAuth = true; // Activer authentication SMTP
    $mail->Username = 'abimmo76@hotmail.com'; // Votre adresse email d'envoi
    $mail->Password = $_SESSION['mail_psw']; // Le mot de passe de cette adresse email
    $mail->SMTPSecure = 'tls'; // Accepter TLS
    $mail->Port = 587;

    $mail->SetFrom('abimmo76@hotmail.com'); //LE MDP EST DANS /etc/nullmailer/remotes
    $mail->FromName = $from;
    // Mail Subject
    $mail->Subject    = $subject;

    //line 1 fixes the line breaks - line 2 the slashes
    $message = nl2br($message);
    $message = stripslashes($message);
    //Main message
    $mail->MsgHTML($message);
    $mail->AddStringAttachment($fichier, $nompiecejointe.'.pdf');

    //Your email, here you will receive the messages from this form.
    //This must be different from the one you use to send emails,
    //so we will just pass email from functions arguments
    $mail->AddAddress($to, "");
    if(!$mail->Send())
    {
        //couldn't send
        return false;
    }
    else
    {
        //successfully sent
        return true;
    }
}

//gmail('johan.pupin@gmail.com','sujet','test corps message');
?>
