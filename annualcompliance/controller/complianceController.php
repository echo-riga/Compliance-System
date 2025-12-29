<?php
    use PHPMailer\PHPMailer\PHPMailer;

    require_once "../sendphpmailer/PHPMailer.php";
    require_once "../sendphpmailer/SMTP.php";
    require_once "../sendphpmailer/Exception.php";

    session_start();
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['add'])) {

                $users_id = $_SESSION['users_id'];
                $category = $_POST['category'];
                $file = $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], "../files/".$file);

                $sql = "SELECT * FROM compliance WHERE users_id = ? AND file = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$users_id,$file]);
                
                if ($stmt->rowcount() > 0) {

                    echo "<script type='text/javascript'>alert('Document Already Exist');</script>";
                    echo "<script>window.location.href='../admin/compliance.php';</script>";

                } else {

                    $sql = "INSERT INTO compliance (users_id,file,category) VALUES (?,?,?)";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$users_id,$file,$category]);


                    echo "<script type='text/javascript'>alert('Successfully Add Document');</script>";
                    echo "<script>window.location.href='../admin/compliance.php';</script>";

                }

            }

            if (isset($_POST['edit'])) {

                $id = $_POST['id'];
                $category = $_POST['category'];
                $file = $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], "../files/".$file);

                if ($file == "") {
                    $sql = "UPDATE compliance SET status = ?, category = ? WHERE id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute(['Pending',$category,$id]);
                } else {
                    $sql = "UPDATE compliance SET file = ?, status = ?, category = ? WHERE id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$file,'Pending',$category,$id]);
                }
                
           
                echo "<script type='text/javascript'>alert('Successfully Edit Document');</script>";
                echo "<script>window.location.href='../admin/compliance.php';</script>";

            }

            if (isset($_POST['delete'])) {

                    $id = $_POST['id'];

                    $sql = "DELETE FROM compliance WHERE id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$id]);


                    echo "<script type='text/javascript'>alert('Successfully Delete Document');</script>";
                    echo "<script>window.location.href='../admin/compliance.php';</script>";
                
            }

            if (isset($_POST['changestatus'])) {

                $id = $_POST['id'];
                $description = $_POST['description'];
                $status = $_POST['status'];

                $sql = "UPDATE compliance SET status = ? WHERE id = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$status,$id]);

                $sql = "SELECT email FROM  compliance INNER JOIN users ON compliance.users_id=users.users_id WHERE compliance.id = '".$id."'";
                $stmt = $this->conn()->query($sql);
                $row = $stmt->fetch();
                $email = $row['email'];

                $mail = new PHPMailer();

                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "asskillia@gmail.com";
                $mail->Password = 'wlnnyntbhngrjqyz';
                $mail->Port = 587;
                $mail->SMTPSecure = "tls";

                $mail->isHTML(true);
                $mail->setFrom('sorar384@gmail.com', 'Annual Compliance');     
                $mail->addAddress($email);
                $mail->Subject = "Status of Compliance Document";
                
                $mail->Body    = $description."<br> Your Compliance has been ".$status;
                $mail->send();

                $xmlFile = 'audit_logs.xml';

                $timestamp = date('c');
                if ($_SESSION['type'] == 2) {
                    $user = 'HR Staff';
                } else {
                    $user = 'HR Officer';
                }
                
                $action = $status." Compliance";
                $details = $description."<br> Your Compliance has been ".$status;

                if (file_exists($xmlFile)) {
                    $xml = simplexml_load_file($xmlFile);
                } else {
                    $xml = new SimpleXMLElement('<?xml version="1.0"?><auditLogs></auditLogs>');
                }

                // Add new log entry
                $log = $xml->addChild('log');
                $log->addChild('timestamp', $timestamp);
                $log->addChild('user', htmlspecialchars($user));
                $log->addChild('action', htmlspecialchars($action));
                $log->addChild('details', htmlspecialchars($details));

                // Save updated XML
                $xml->asXML($xmlFile);
           
                echo "<script type='text/javascript'>alert('Successfully Send Email');</script>";
                echo "<script>window.location.href='../admin/compliance.php';</script>";

            }

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
