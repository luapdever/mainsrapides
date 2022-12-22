<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function send_mail(String $from = "contact@mainsrapides.com", String $to, String $subject, String $body, ?array $data = []) {
    $mail = new PHPMailer();

    try {
        $mail->isSMTP();
        // $mail->Host = 'localhost';
        // $mail->SMTPAuth = true;
        // $mail->SMTPAuth = false;
        // $mail->SMTPAutoTLS = false;
        // $mail->Port = 1025; // 587

        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "contact.dever511@gmail.com";
        $mail->Password   = "your-gmail-password";

        $mail->setFrom($from, 'Mainsrapides');
        $mail->addAddress($to);
        
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            </head>
            <body style="background: #e5e5e5; padding: 30px;" >

                <div style="max-width: 320px; margin: 0 auto; padding: 20px; background: #fff; word-wrap: break-word;">
                    '. $body . '
                </div>

            </body>
            </html>
        ';

        $mail->send();
        
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }

    return true;
}


function confirm_email($user) {
    $token = bin2hex(random_bytes(32));
    $full_url = $GLOBALS["app_url"] . '/confirm_mail.php?id=' . $user["id"] . '&token=' . $token;

    $message = '
        <p>
            <strong>'. get_full_name($user) .'</strong>, Confirmer votre mail en 
            <a href="' . $full_url .'">cliquant ici.</a> ou copier-coller le lien ci-dessous: <br /><br />
            <a href="' . $full_url .'">' . $full_url .'</a>
        </p>
    ';

    $res = send_mail("contact@mainsrapides.com", $user["email"], "Confirmer votre email", $message);

    if($res) {
        return $token;
    } else {
        return null;
    }
}

?>