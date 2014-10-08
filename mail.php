<?php

header('Content-Type: text/html; charset=utf-8'); 
$is_ok = false;
$use_captcha = true;
if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
  AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
  $use_captcha = false;
  $is_ok = true;
}

$result = ''; 

ini_set('display_errors', 0);
// Include the SDK
require_once('PHPM/class.phpmailer.php');
$mail = new PHPMailer();
require_once('Translator.php');
$translator = new Translator('ru');

 

    $message = "Сообщение с формы: <br /><br />";
    foreach ($_POST as $key => $value) {
         $message.=  $translator->trans( $key ) ." : " . $translator->trans( $value )  . "<br />";
    }
 
 
    $mail->IsSMTP(); // telling the class to use SMTP

    //$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "tls";                 // sets the prefix to the server
    $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
    $mail->Username   = "arnet.cf@gmail.com";  // GMAIL username
    $mail->Password   = "GmxnHAqZGi";          // GMAIL password
    $mail->CharSet    = "utf-8";

    $mail->SetFrom('no-reply@tubusiness.ru', 'TUBusiness');
    $mail->AddReplyTo($_POST['email'],$_POST['name']);
    $mail->Subject    = "Письмо с сайта от ".$_POST['name'];
    $mail->AddAddress('dolphin.daniel@gmail.com');
    $mail->MsgHTML($message);
 
    if($mail->Send()) {
      $result = "Ваше сообщение отправлено, в ближайшее время менеджер свяжется с вами.";
    } else {
      $result = "Не удалось отправить, попробуйте позже!";
    }
  

  if ($use_captcha == false) {
    die(json_encode(array('result' => $result)));
  } else {
    $result = $result."<br />";
  }
 
?>

