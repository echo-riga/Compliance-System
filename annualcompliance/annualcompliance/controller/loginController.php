<?php

    session_start();
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){ 
         
            if (isset($_POST['login'])) {

                $currentdatetime = date('Y-m-d H:i:s');

                unset($_SESSION['passphrase']);

                $emailemployeeid = $_POST['emailemployeeid'];
                $password = $_POST['password'];

                $sql = "SELECT * FROM users WHERE email = ? OR employeeid = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$emailemployeeid,$emailemployeeid]);

                if ($stmt->rowcount() > 0) {

                    $row = $stmt->fetch();

                    if ($row['datetime'] >= $currentdatetime) {

                        echo "<script type='text/javascript'>alert('Too many Attempt Please try again later');</script>";
                        echo "<script>window.location.href='../admin/index.php';</script>";

                    } else {

                        if (password_verify($password, $row['password'])) {

                            $_SESSION['passphrase'] = $row['passphrase'];



                                if ($row['status'] == 1) {

                                    $_SESSION['users_id'] = $row['users_id'];

                                    header('location:../admin/otpoption.php');
                                
                                } else {

                                    echo "<script type='text/javascript'>alert('Waiting for Approval Account');</script>";

                                }


                                

                            
                        } else {

                            $attempt = $row['attempt'] + 1;

                            if ($attempt >= 4) {
                                
                                $datetime = date('Y-m-d H:i:s', strtotime('+1 hour'));

                                $sql = "UPDATE users SET attempt = ? ,datetime = ? WHERE email = ? OR employeeid = ?";
                                $stmt = $this->conn()->prepare($sql);
                                $stmt->execute([0,$datetime,$emailemployeeid,$emailemployeeid]);


                            } else { 

                                $sql = "UPDATE users SET attempt = ? WHERE email = ? OR employeeid = ?";
                                $stmt = $this->conn()->prepare($sql);
                                $stmt->execute([$attempt,$emailemployeeid,$emailemployeeid]);

                            }

                            

                            echo "<script type='text/javascript'>alert('Invalid Username And Password');</script>";
                            echo "<script>window.location.href='../admin/index.php';</script>";

                        }

                    }

                    echo "<script>window.location.href='../admin/index.php';</script>";
                    
                } else {

                    echo "<script type='text/javascript'>alert('Invalid Username And Password');</script>";
                    echo "<script>window.location.href='../admin/index.php';</script>";

                } 
               
            } 

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
