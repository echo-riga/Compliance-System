<?php

    session_start();
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){ 
         
            if (isset($_POST['login'])) {

                $passphrase = $_POST['passphrase'];

                $sql = "SELECT * FROM users WHERE passphrase = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$passphrase]);

                if ($stmt->rowcount() > 0) {

                    $row = $stmt->fetch();

                    $_SESSION['users_id'] = $row['users_id'];
                    $_SESSION['type'] = $row['type'];

                        
                        header('location:../admin/dashboard.php');

                    
                    
             

                } else {

                    echo "<script type='text/javascript'>alert('Invalid Passphrase Key Word');</script>";
                    echo "<script>window.location.href='../admin/passphrasekeyword.php';</script>";

                } 
               
            } 

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
