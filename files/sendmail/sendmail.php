<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	/*
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'user@example.com';                     //SMTP username
	$mail->Password   = 'secret';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                 
	*/



	//Від кого лист
	$mail->setFrom('from@gmail.com', 'Тестовий емейл'); // Вказати потрібний E-mail
	//Кому відправити
	$mail->addAddress('to@gmail.com'); // Вказати потрібний E-mail
	//Тема листа
	$mail->Subject = 'Вітання! Ви отримали відправку форми Globals Litera Team.';

	//Тіло листа
	$body = '<h1>Вам було надіслано форму з сайту Global Math Systems.</h1>';

	if(trim(!empty($_POST['name']))){
		$body.= "<p><strong>Name:</strong> ".$_POST['name']. "</p>";
	}	
	if(trim(!empty($_POST['email']))){
		$body.= "<p><strong>Email:</strong> ".$_POST['email']. "</p>";
	}	
	if(trim(!empty($_POST['phone']))){
		$body.= "<p><strong>Телефон:</strong> ".$_POST['phone']. "</p>";
	}	
	if(trim(!empty($_POST['subject']))){
		$body.= "<p><strong>Тема:</strong> ".$_POST['subject']. "</p>";
	}	
	

	//if(trim(!empty($_POST['email']))){
		//$body.=$_POST['email'];
	//}	
	
	/*
	//Прикріпити файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//шлях завантаження файлу
		$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
		//грузимо файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото у додатку</strong>';
			$mail->addAttachment($fileAttach);
		}
	}
	*/

	$mail->Body = $body;

	//Відправляємо
	if (!$mail->send()) {
		$message = 'Error!';
	} else {
		$message = 'Form submitted';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>