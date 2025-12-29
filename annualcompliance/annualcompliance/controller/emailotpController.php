<?php

    session_start();
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){ 
         
            if (isset($_POST['emailotp'])) {

                $code = $_POST['code'];


                if ($code == 0 OR $code == "") {
                    
                    echo "<script type='text/javascript'>alert('Invalid OTP Code');</script>";
                    echo "<script>window.location.href='../admin/emailotp.php';</script>";

                } else {

                    $sql = "SELECT * FROM users WHERE code = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$code]);

                    if ($stmt->rowcount() > 0) {

                        $row = $stmt->fetch();

                        $_SESSION['users_id'] = $row['users_id'];
                        $_SESSION['type'] = $row['type'];

                        echo "<script type='text/javascript'>alert('Successfully Login');</script>";
                        echo "<script>window.location.href='../admin/dashboard.php';</script>";
                        
                    } else {

                        echo "<script type='text/javascript'>alert('Invalid OTP Code');</script>";
                        echo "<script>window.location.href='../admin/emailotp.php';</script>";

                    } 

                }

            } 

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
