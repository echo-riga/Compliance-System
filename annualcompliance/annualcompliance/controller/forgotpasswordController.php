<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;

    require_once "../sendphpmailer/PHPMailer.php";
    require_once "../sendphpmailer/SMTP.php";
    require_once "../sendphpmailer/Exception.php";


    include '../config/config.php';

    class staff extends Connection{

        public function managestaff(){
            if (isset($_POST['forgotpassword'])) {

                $email = $_POST['email'];
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
                    $mail->Username = "sorar384@gmail.com";
                    $mail->Password = 'ukjqeppzrfugeqgx';
                    $mail->Port = 587;
                    $mail->SMTPSecure = "tls";

                    $mail->isHTML(true);
                    $mail->setFrom('sorar384@gmail.com', 'Change Password');     
                    $mail->addAddress($email);
                    $mail->Subject = "Change Password";
                    $mail->Body    = '
                          <div style="font-size:20px;">
                          Good day!<br><br>
                          Click <a href="localhost/annualcompliance/admin/changepassword.php?code='.$code.'">here</a> to Change Your Password</div></div>';
                    $mail->send();

                    echo "<script type='text/javascript'>alert('Successfully Send Email');</script>";
                    echo "<script>window.location.href='../admin/index.php';</script>";
                  

                } else {

                    echo "<script type='text/javascript'>alert('Invalid Email');</script>";
                    echo "<script>window.location.href='../admin/forgotpassword.php';</script>";

                } 
               
            } 

        }

    }

    $staffrun = new staff();
    $staffrun->managestaff();

?>
