<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;

    require_once "../sendphpmailer/PHPMailer.php";
    require_once "../sendphpmailer/SMTP.php";
    require_once "../sendphpmailer/Exception.php";


    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){

                $users_id = $_SESSION['users_id'];
                $sql = "SELECT * FROM users WHERE users_id = '".$users_id."'";
                $stmt = $this->conn()->query($sql);
                $row = $stmt->fetch();

                $email = $row['email'];
                $code = rand(000000,999999);

                $sql = "SELECT * FROM users WHERE email = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$email]);

                if ($stmt->rowcount() > 0) {

                    $row = $stmt->fetch();

                    $_SESSION['questionnaire'] = $row['questionnaire'];

                    $sql = "UPDATE users SET code = ? WHERE email = '".$email."'";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$code]);

                    $mail = new PHPMailer();

                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "asskillia@gmail.com";
                    $mail->Password = 'wlnnyntbhngrjqyz';
                    $mail->Port = 587;
                    $mail->SMTPSecure = "tls";

                    $mail->isHTML(true);
                    $mail->setFrom('asskillia@gmail.com', 'OTP Code');     
                    $mail->addAddress($email);
                    $mail->Subject = "OTP Code";
                    $mail->Body    = '
                          <div style="font-size:20px;">
                          OTP:'.$code.'</div>';
                    $mail->send();

                    echo "<script type='text/javascript'>alert('Successfully Send Email');</script>";
                    echo "<script>window.location.href='../admin/emailotp.php';</script>";
                  
                }
               
        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
