<?php


    /* PHPMailer files
    ========================================================================== */
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';


    /* Main email address
    ========================================================================== */
    $email_address = 'example@example.com';
    $your_name     = 'Your name';


    /* SMTP email username and password
    ========================================================================== */
    $SMTP_Server   = 'false';
    $SMTP_Username = 'example@gmail.com';
    $SMTP_Password = 'example@gmail.com password';


    /* reCaptcha
    ========================================================================== */
    $secretKey = '6LebZIAUAAAAADiZCqcJjea4l7OCog7_-0VoSPZc';

    if ( isset( $_POST['g-recaptcha-response'] ) ) {
        $captcha = $_POST['g-recaptcha-response'];
    } else {
        echo '<div class="error-message">Please check the the captcha keys.</div>';
        exit;
    }

    $url          = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode( $secretKey ) .  '&response=' . urlencode( $captcha );
    $response     = file_get_contents( $url );
    $responseKeys = json_decode( $response, true );

    if ( $responseKeys['success'] === false ) {
        echo '<div class="error-message">' . $responseKeys['error-codes'][0] . '</div>';
        exit;
    }


    /* Form variables
    ========================================================================== */
    $form_name    = $_POST['form_name'];
    $form_email   = $_POST['form_email'];
    $form_rsvp    = $_POST['form_select'];
    $form_domain  = $_POST['form_domain'];


    /* Message
    ========================================================================== */
    $email_subject = "You've been contacted by: " . $form_name;
    $email_body    =
"You have been contacted by <b>$form_name</b> with regards to Wedding RSVP and <b>$form_name</b> will attend to $form_rsvp
<br><br>
$form_message
<br><br>
...............................................
<br><br>
Contact details:
<br><br>
Email Address: $form_email
<br><br>
This e-mail was sent via a contact form from $form_domain
";


    /* Send
    ========================================================================== */
    $mail          = new PHPMailer;
    $mail->CharSet = 'UTF-8';

    // SMTP server
    if ( $SMTP_Server === 'true' ) {
        $mail->isSMTP();
        $mail->SMTPDebug  = 0;
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $SMTP_Username;
        $mail->Password   = $SMTP_Password;
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
    }

    $mail->isHTML(true);
    $mail->SetFrom( $form_email, $form_name );
    $mail->addAddress( $email_address, $your_name );
    $mail->addReplyTo( $form_email, $form_name );

    $mail->Subject = $email_subject;
    $mail->Body    = $email_body;

    if ( !$mail->send() ) {
        echo '<div class="error-message">Message could not be sent: ' . $mail->ErrorInfo . '</div>';
    } else {
        echo '<div class="success-message">Thank you ' . $form_name . ', we have received your message and will get back to you asap.</div>';
    }


?>