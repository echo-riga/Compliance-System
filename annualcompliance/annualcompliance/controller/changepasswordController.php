<?php

    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['changepassword'])) {

                $code = $_POST['code'];
                $answer = $_POST['answer'];

                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $confirmpassword = $_POST['confirmpassword'];
                $passwordtxt = $_POST['password'];

                    if ($_POST['password'] != $confirmpassword) {

                        echo "<script type='text/javascript'>alert('Password Not Match');</script>";
                        echo "<script>window.location.href='../admin/changepassword.php?code=".$code."';</script>";

                    } else {

                        $sql = "SELECT * FROM users WHERE code = ? AND answer = ?";
                        $stmt = $this->conn()->prepare($sql);
                        $stmt->execute([$code,$answer]);

                        if ($stmt->rowcount() > 0) {

                            $sql = "UPDATE users SET password = ?, passwordtxt = ? WHERE code = ? AND answer = ?";
                            $stmt = $this->conn()->prepare($sql);
                            $stmt->execute([$password,$passwordtxt,$code,$answer]);

                            echo "<script type='text/javascript'>alert('Successfully Change Password');</script>";
                            echo "<script>window.location.href='../admin/index.php';</script>";

                        } else {

                            echo "<script type='text/javascript'>alert('Invalid Credentials');</script>";

                        } 

                        echo "<script>window.location.href='../admin/changepassword.php?code=".$code."';</script>";

                    }
               
            }

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
