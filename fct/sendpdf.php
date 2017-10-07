<?php
function envoimail($from, $to, $subject, $message, $fichier, $nompiecejointe){
    //path to PHPMailer class
    require_once('./phpmailer/PHPMailerAutoload.php');



    $mail = new PHPMailer();
    $mail->CharSet = "UTF-8";
    // telling the class to use SMTP
    //$mail->IsSMTP();
    // enables SMTP debug information (for testing)
    // 1 = errors and messages
    // 2 = messages only
    //$mail->SMTPDebug  = 2;
    //$mail->Debugoutput = 'html';
    //$mail->SMTPKeepAlive = true;
    // enable SMTP authentication
    //$mail->SMTPAuth   = true;

    //$mail->SMTPSecure = "tls";
    // sets  the SMTP server
    $mail->Host       = "localhost"; //smtp-mail.outlook.com

    // set the SMTP port for the GMAIL server
    //$mail->Port       = 587;
    // GMAIL username
    //$mail->Username   = "arnaudbinet@hotmail.com";
    // GMAIL password
    //$mail->Password   = "db060557";
    //Set reply-to email this is your own email, not the gmail account
    //used for sending emails
    $mail->SetFrom('arnaudbinet@hotmail.com');
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
