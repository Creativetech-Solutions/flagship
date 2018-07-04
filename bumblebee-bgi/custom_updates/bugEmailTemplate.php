<?php
/**
 * Created by PhpStorm.
 * User: HI
 * Date: 9/2/2016
 * Time: 2:54 PM
 */

require_once $_SERVER['DOCUMENT_ROOT'].'flights_project/phpMailer/PHPMailerAutoload.php';

$mail = new PHPMailer();
//sendPHPMailer($mail);
function sendBugEmail($to = '', $from = '',$subject = '', $message = ''){
    $to = 'haideritx@gmail.com';

    if(empty($subject)){
        $subject = 'Website Change Request';
    }


    $headers = "From: " . strip_tags('flagship@gmail.com') . "\r\n";
    $headers .= "Reply-To: ". strip_tags('flagship@demo.com') . "\r\n";
    $headers .= "CC: susan@example.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    if(empty($message)){
        $message = '<html><body>';
        $message .= '<img src="//css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags('Syed Haider') . "</td></tr>";
        $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags('haideritx@gmail.com') . "</td></tr>";
        $message .= "<tr><td><strong>Type of Change:</strong> </td><td>" . strip_tags('typeOfChange') . "</td></tr>";
        $message .= "<tr><td><strong>Urgency:</strong> </td><td>" . strip_tags('urgency') . "</td></tr>";
        $message .= "<tr><td><strong>URL To Change (main):</strong> </td><td>" . 'URL-main' . "</td></tr>";
        $addURLS = '';
        if (($addURLS) != '') {
            $message .= "<tr><td><strong>URL To Change (additional):</strong> </td><td>" . strip_tags($addURLS) . "</td></tr>";
        }
        $message .= "<tr><td><strong>NEW Content:</strong> </td><td>" . htmlentities('IM the New Text') . "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";
    }


    //Finally Email it.
    $sent = @mail($to, $subject, $message, $headers);

    if($sent){
        return "OK::email Sent";
    }else{
        echo "FAIL::Could Not Sent Email";
    }
}

function sendPHPMailer($mail){
    $mail->setFrom('from@example.com', 'First Last');
    $mail->addReplyTo('haideritx@gmail.com', 'First Last');
    $mail->addAddress('haideritx@gmail.com', 'Haider Hassan');

    //Set the subject line
$mail->Subject = 'PHPMailer mail() test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
$mail->msgHTML("<html><body>Hello world</body></html>");
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

    //send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }
}


