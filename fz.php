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
session_start();

ini_set('display_errors', 0);
// Include the SDK
require_once('PHPM/class.phpmailer.php');
$mail             = new PHPMailer();

if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone']) && $_POST['text']) {

  if($use_captcha and $_SESSION['captcha'] === md5($_POST['code'])) {
    $is_ok = true;
  }

  if($is_ok) {
    $message = "Сообщение от потенциального заказчика: <br /><br />Имя: ".$_POST['name'].
          "<br />e-mail: ".$_POST['email']."<br />Требуется: ".$_POST['choice1'].",".$_POST['choice2'].
          ",".$_POST['choice3'].",".$_POST['choice4']."<br />Текст сообщения:<br />".$_POST['text']."<br />Телефон для связи: ".$_POST['phone'].
          "<br />Дополнительная информация:<br />Метраж: ".$_POST['metr']."<br />Район: ".$_POST['district'].
          "<br />Состояние объекта: ".$_POST['sost'];

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

    $mail->SetFrom('no-reply@arnet.ru', 'арнэт');
    $mail->AddReplyTo($_POST['email'],$_POST['name']);
    $mail->Subject    = "Письмо с сайта от ".$_POST['name'];
    $mail->AddAddress('dolphin.daniel@gmail.com');
    $mail->MsgHTML($message);

    $_SESSION['captcha'] = md5(uniqid());
    if($mail->Send()) {
      $result = "Ваше сообщение отправлено, в ближайшее время менеджер свяжется с вами.";
    } else {
      $result = "Не удалось отправить, попробуйте позже!";
    }
  }

  if ($use_captcha == false) {
    die(json_encode(array('result' => $result)));
  } else {
    $result = $result."<br />";
  }
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
<!-- meta http-equiv="Content-Type" content="text/html; charset=windows-1251" / -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <meta name="keywords" content="дизайн интерьера квартир ремонт" />
  <meta name="description" content="ремонт квартир, дизайн интерьера, Компания Арнет реализует идеи своих клиентов, выполняя полный комплекс услуг в области дизайна интерьера и ремонта." />
  <title>Форма заказа</title>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
  <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
  <script type="text/javascript" src="/js/jquery.hint.js"></script>
  <script type="text/javascript" src="/js/ordering.js"></script>
  <link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="css/contacts.css" type="text/css" media="screen" />
  <script type="text/javascript">
var __cs = __cs || [];
__cs.push(["setAccount", "N7F75L68AcCpP0cInIHOfpW8uX3fgR33"]);
__cs.push(["setHost", "http://server.comagic.ru/comagic"]);
</script>
<script type="text/javascript" async src="http://app.comagic.ru/static/cs.min.js"></script>
</head>
<body>
<!-- Yandex.Metrika counter -->
<script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript"></script>
<script type="text/javascript">
  try { var yaCounter112645 = new Ya.Metrika({id:112645,
    webvisor:true,
    clickmap:true,
    trackLinks:true,
    accurateTrackBounce:true,
    trackHash:true});
  } catch(e) { }
</script>
<noscript><div><img src="//mc.yandex.ru/watch/112645" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
    
<!-- Google Universal Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-12408031-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- Google Universal Analytics -->


<div class="header"> <a href="/"><img src="images/logo.jpg" /></a> </div>
<div class="tel"><a href="/about.php#contacts"><img src="images/phone.png" /><strong><span>(495) </span></strong><strong id="comagic_phone">505-25-15</strong><p>отдел по работе с клиентами</p></a></div>
<div class="main">
  <div class="menu">
    <div class="menu_button"> <a href="portfolio.php">портфолио</a></div>
    <div class="menu_button"> <a href="building.html">ремонт</a></div>
    <div class="menu_button"> <a href="design.html">проектирование</a></div>
    <div class="menu_button"> <a href="about.html">о компании</a></div>
  </div>

<!-- content -->
<div class="content2">


<div class="pane">

<div class="art">


<table id="cform">
<tr><td colspan="3"><h2>Чтобы сделать заказ:</h2></tr>
	<tr>
	<td class="left">
		<p><b>cвяжитесь с менеджером по телефонам:</b></p>
		<p>
		(495) 505-25-15<br />

		(495) 505-35-62<br />

		(495) 505-35-72
		</p>
	</td>
	<td class="ili">
		<p><b>или</b></p>
	</td>
	<td>
		<p><b>отправьте заявку нам на почту:</b></p>
    <?php if(empty($result)) : ?>
		<form id="mailer" action="fz.php" method="post"  name="mailer">
		Какая услуга вам требуется?<br/>
		<input name="choice1" value="Дизайн-проект" type="checkbox" />&nbsp;Дизайн-проект<br/>
		<input name="choice2" value="Проект коттеджа" type="checkbox" />&nbsp;Проект коттеджа<br/>
		<input name="choice3" value="Ремонт" type="checkbox" />&nbsp;Ремонт<br/>
		<input name="choice4" value="Согласование" type="checkbox" />&nbsp;Согласование<br/><br/>
		<a id="toggler" href="#" class="dot">[+] Дополнительная информация по объекту</a><br/><br/>
		<div id="box" style="display: none;">
			<input class="dop" name="metr" title="Метраж" value="" type="text" />&nbsp;&nbsp;
			<input class="dop" name="district" title="Район" value="" value="Район" type="text" /><br/><br/>
			<input name="sost" value="Новостройка" type="radio" />Новостройка&nbsp;&nbsp;<input name="sost" value="Вторичное жильё" type="radio" />Вторичное жильё<br/>
		</div>
		<div id="cont">
		<input name="name" id="name" title="Ваше имя" value="" type="text" />
		<input name="email" id="email" title="Ваш e-mail" value="" type="text" />
		<input name="phone" id="phone" title="Телефон для связи" value="" type="text" />
		</div>
		  <textarea name="text" title="Ваши комментарии к заявке"></textarea>
			Введите текст с картинки:
			<img src="captcha.php" /> 
			<input name="code" type="text" style="width: 77px;">
		<input class="submit" value="Отправить" type="submit" />
		</form>
    <?php else: /*if(empty($result))*/
    print $result;
    endif; /*if(empty($result))*/ ?>
	</td>
	</tr>
</table>
</div>
</div>





</div>

<!-- end of content --> </div>

<div class="article_overlay" id="article1">
<div class="content_wrap"></div>

</div>

<div class="article_overlay" id="article2">
<div class="content_wrap"></div>

</div>

<div class="footer">
<a href="/about.php#contacts">Москва, улица Профсоюзная, дом 3</a> <a href="/about.php#contacts">+7 (495) 505-25-15</a><?php require_once 'check_fav.php';?>

<font><a target="_blank" href="http://www.facebook.com/arnet.ru">Читайте нас в <img src="images/facebook_logo.gif"></a>Copyright &copy; 2001-2014 "Арнэт"</font></div>

<div class="overlay_back" onclick="close_description();"></div>

<div class="description_overlay"></div>


</body>
</html>
