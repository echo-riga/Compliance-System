<?php
    
    include '../config/config.php';
    session_start();
    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['saveadmin'])) {

                $users_id = $_SESSION['users_id'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $middlename = $_POST['middlename'];
                $address = $_POST['address'];
                $email = $_POST['email'];
                $contact = $_POST['contact'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $questionnaire = $_POST['questionnaire'];
                $answer = $_POST['answer'];
                $img = $_FILES['img']['name'];
                move_uploaded_file($_FILES['img']['tmp_name'], "../images/".$img);
                
                if ($img == '') {
                    $sqlinsert = "UPDATE users SET firstname = ?, lastname = ?, middlename = ?, address = ?, contact = ?, email = ?,password = ?,passwordtxt = ? ,questionnaire = ? ,answer = ? WHERE users_id = '".$users_id."'";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$firstname,$lastname,$middlename,$address,$contact,$email,$password,$_POST['password'],$questionnaire,$answer]);

                } else {

                    $sqlinsert = "UPDATE users SET img = ?, firstname = ?, lastname = ?, middlename = ?, address = ?, contact = ?, email = ?,password = ?,passwordtxt = ? ,questionnaire = ? ,answer = ? WHERE users_id = '".$users_id."'";
                    $statementinsert = $this->conn()->prepare($sqlinsert);
                    $statementinsert->execute([$img,$firstname,$lastname,$middlename,$address,$contact,$email,$password,$_POST['password'],$questionnaire,$answer]);
               
                    
                }

                echo "<script type='text/javascript'>alert('Successfully Edit Profile');</script>";

                if ($_SESSION['type'] == 1) {
                    
                    echo "<script>window.location.href='../admin/dashboard.php';</script>";

                } else {

                    echo "<script>window.location.href='../admin/dashboard.php';</script>";

                }

                
                    
            }

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
