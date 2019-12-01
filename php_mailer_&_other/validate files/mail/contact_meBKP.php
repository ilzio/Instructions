<?php

include_once 'PHPMailer/PHPMailer.php';
// include_once 'PHPMailer/Exception.php';
include_once 'PHPMailer/SMTP.php';

// Check for empty fields

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

date_default_timezone_set("America/Sao_Paulo");
$sent_on_time = date("G:i:s");
$sent_on_date = date("d-m-Y");

if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['city']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	http_response_code(500);
	exit();
}

//Treating input from form

$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$message = strip_tags(htmlspecialchars($_POST['message']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));


$mail = new PHPMailer();
try {

	// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Port = 465;
	$mail->SMTPSecure = 'ssl';
	$mail->Username = 'mailer.NAME@gmail.com';
	$mail->Password = '';

	$mail->setFrom('mailer.NAME@gmail.com');
	// $mail->addAddress('contato@NAME.com.br'); // Add a recipient
	$mail->addAddress('mailer.NAME@gmail.com'); // Add a recipient


	$mail->addReplyTo($email_address, $name);
// $mail->addCC('cc@example.com');
	// $mail->addBCC('bcc@example.com');

	$mail->isHTML(true); // Set email format to HTML
	$mail->Subject = 'Mensagem do formulario de contato NAME';
	$mail->Body = '<h2 style="font-family: Arial, Helvetica, sans-serif;">Nova mensagem do site Janela8</h2><hr><br>
		
		<p style="font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Nome: </span>' . $name . '</p>
		<p style="font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Email: </span>' . $email_address . '</p>
		 <p style="font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Telefone: </span>' . $phone . '</p>
		 
		<p style="font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Mensagem: </span><br>' . $message . ';</p><hr>' . '<p>Mensagem enviada as ' . $sent_on_time . ' do ' . $sent_on_date . '</p>';

	$mail->AltBody = "Mensagem do site NAME.\n\n" . "Detalhes:\n\nNome: $name\n\nEmail: $email_address\n\nTelefone: $phone\n\nMensagem:\n$message\n\n Enviado as $sent_on_time do $sent_on_date";

	$mail->send();

} catch (Exception $e) {
	$error_msg= "Message could not be sent. Mailer Error:  $mail->ErrorInfo";

}


