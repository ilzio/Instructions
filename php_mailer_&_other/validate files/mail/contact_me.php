<?php

include_once 'PHPMailer/PHPMailer.php';
// include_once 'PHPMailer/Exception.php';
include_once 'PHPMailer/SMTP.php';

// errors

$fp = fopen('/home/$USERNAME/Desktop/log.txt', 'w+');

fwrite($fp, "pre verification, post: " . json_encode($_POST) . "\n\n Files : " . json_encode($_FILES));

$results = print_r($_POST, true);

fwrite($fp, print_r($_POST, true));

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set("America/Sao_Paulo");
$sent_on_time = date("G:i:s");
$sent_on_date = date("d-m-Y");

if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']) || empty($_POST['subject']) || empty($_POST['city']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {


fwrite($fp, 'first verification, post: ' . $_POST . "\n\n Files : $_FLIES" );
fclose($fp);


	http_response_code(500);



	exit();
}

var_dump($_POST);
var_dump($_FILES);

// die();

//Treating input from form

$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$message = strip_tags(htmlspecialchars($_POST['message']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$subject = strip_tags(htmlspecialchars($_POST['subject']));

$city = strip_tags(htmlspecialchars($_POST['city']));

if (array_key_exists('userfile', $_FILES)) {
try {
    if (
        !isset($_FILES['userfile']['error']) ||
        is_array($_FILES['userfile']['error'])
    ) {
        throw new RuntimeException('Invalid parameters.');
    }
    
    // Check $_FILES['userfile']['error'] value.
    switch ($_FILES['userfile']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    // You should also check filesize here. 
    if ($_FILES['userfile']['size'] > 1000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);

    if (false === $ext = array_search(
        $finfo->file($_FILES['userfile']['tmp_name']),
        array(
            'pdf' => 'application/pdf',
            'odt' => 'application/vnd.oasis.opendocument.text',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
        ),
        true
    )) {
        throw new RuntimeException('Invalid file format.');
    }

     $uploadfile = tempnam(sys_get_temp_dir(), hash('sha256', $_FILES['userfile']['name']));
     echo $uploadfile;
     echo "<br>";
     
     $file_name = 'anexo_'.$name.'_'.$sent_on_date.'.'.$ext;

     // die();

    if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        throw new RuntimeException('Failed to move uploaded file.');
    } 
}
 catch (RuntimeException $e) {
    echo $e->getMessage();
}
}

$mail = new PHPMailer();
try {
	


	// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
	// $mail->isSMTP();
	// $mail->Host = 'smtp.gmail.com';
	// $mail->SMTPAuth = true;
	// $mail->Port = 465;
	// $mail->SMTPSecure = 'ssl';
	// $mail->Username = 'ADDRESS@gmail.com';
	// $mail->Password = 'PASSWORD';

	// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->Host = 'smtp.mailtrap.io';
	$mail->SMTPAuth = true;
	$mail->Port = 2525;
	// $mail->SMTPSecure = 'ssl';
	$mail->Username = '';
	$mail->Password = '';

	$mail->setFrom('ADDRESS@gmail.com');
	// $mail->addAddress('contato@NAME.com.br'); // Add a recipient
	$mail->addAddress('ADDRESS@gmail.com'); // Add a recipient

	 $mail->addAttachment($uploadfile, $file_name);


	$mail->addReplyTo($email_address, $name);
// $mail->addCC('cc@example.com');
	// $mail->addBCC('bcc@example.com');

	$mail->isHTML(true); // Set email format to HTML
	$mail->Subject = 'Mensagem do formulario de contato NAME';
	$mail->Body = '<h2 style="font-family: Arial, Helvetica, sans-serif;">Nova mensagem do site NAME</h2><hr><br>
		
		<p style="font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Assunto: </span>' . $subject . '</p>
		<p style="font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Nome: </span>' . $name . '</p>
		<p style="font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Email: </span>' . $email_address . '</p>
		 <p style="font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Telefone: </span>' . $phone . '</p>
		 <p style="font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Cidade: </span>' . $city . '</p>
		 
		<p style="font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Mensagem: </span><br>' . $message . ';</p><hr>' . '<p>Mensagem enviada as ' . $sent_on_time . ' do ' . $sent_on_date . '</p>';

	$mail->AltBody = "Mensagem do site NAME.\n\n" . "Detalhes:\n\nAssunto: $subject\n\nNome: $name\n\nEmail: $email_address\n\nTelefone: $phone\n\nCity: $city\n\nMensagem:\n$message\n\n Enviado as $sent_on_time do $sent_on_date";

	$mail->send();

} catch (Exception $e) {
	$error_msg= "Message could not be sent. Mailer Error:  $mail->ErrorInfo";

}



