<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once "PHPMailer.php";
require_once "SMTP.php";
require_once "Exception.php";


                

				 $mail = new PHPMailer();

				$mail->isSMTP();
				$mail->Host = "smtp.gmail.com";
				$mail->SMTPAuth = true;
				$mail->Username = "sorar384@gmail.com";
				$mail->Password = 'ukjqeppzrfugeqgx';
				$mail->Port = 587;
				$mail->SMTPSecure = "tls";

				$mail->isHTML(true);
				$mail->setFrom('sorar384@gmail.com', 'SESL');     
				$mail->addAddress('jethroaranas367@gmail.com');
				$mail->Subject = "SESL Subscription";
			   
                       
				$mail->Body    = '
				      <div style="text-align:center;font-size:24px;">
				      Good day!<br><br>
				     <div style="background-color:#222549;border-radius:20px;width:500px;margin:auto;color:#fff;font-size:24px;padding:20px 10px;">Your Subscription has been Expired</div>
				     <img src="cid:tirle" alt = "Tirle" width = "60" height = "60">
				     </div> 
				      ';

				      // $mail->addAttachment($image, 'temp/');
				$mail->AddEmbeddedImage('../temp/tirle.jpg', 'tirle');

				$mail->send();
?>