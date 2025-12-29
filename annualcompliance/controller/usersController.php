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

                $employeeid = $_POST['employeeid'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $middlename = $_POST['middlename'];
                $birthdate = $_POST['birthdate'];
                $email = $_POST['email'];
                $formattedBirthdate = str_replace("-", "", $birthdate);
                $password = password_hash($employeeid . $formattedBirthdate, PASSWORD_DEFAULT);
                // $confirmpassword = $_POST['confirmpassword'];
                $status_of_employment = $_POST['status_of_employment'];
                $passwordtxt = $employeeid . $formattedBirthdate;

                // if ($_POST['password'] != $confirmpassword) {
                //     echo "<script type='text/javascript'>alert('Password Not Match');</script>";
                //     echo "<script>window.location.href='../admin/users.php';</script>";
                // }

                $sql = "SELECT * FROM users WHERE employeeid = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$employeeid]);
                
                if ($stmt->rowcount() > 0) {

                    echo "<script type='text/javascript'>alert('User Already Exist');</script>";
                    echo "<script>window.location.href='../admin/users.php';</script>";

                } else {

                    $sql = "INSERT INTO users (employeeid,firstname,lastname,middlename,birthdate,email,password,passwordtxt,status_of_employment) VALUES (?,?,?,?,?,?,?,?,?)";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$employeeid,$firstname,$lastname,$middlename,$birthdate,$email,$password,$passwordtxt,$status_of_employment]);


                    echo "<script type='text/javascript'>alert('Successfully Add Employee');</script>";
                    echo "<script>window.location.href='../admin/users.php';</script>";

                }

            }

            if (isset($_POST['edit'])) {

                $id = $_POST['id'];
                $employeeid = $_POST['employeeid'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $middlename = $_POST['middlename'];
                $birthdate = $_POST['birthdate'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirmpassword = $_POST['confirmpassword'];
                $status_of_employment = $_POST['status_of_employment'];

                $sql = "UPDATE users SET employeeid = ?, firstname = ?, lastname = ?, middlename = ?, birthdate = ?, email = ?, password = ?, confirmpassword = ?, status_of_employment = ? WHERE id = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$employeeid,$firstname,$lastname,$middlename,$birthdate,$email,$password,$confirmpassword,$status_of_employment,$id]);
           
                echo "<script type='text/javascript'>alert('Successfully Edit Employee');</script>";
                echo "<script>window.location.href='../admin/users.php';</script>";

            }

            if (isset($_POST['delete'])) {

                    $id = $_POST['id'];

                    $sql = "DELETE FROM users WHERE id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$id]);


                    echo "<script type='text/javascript'>alert('Successfully Delete Employee');</script>";
                    echo "<script>window.location.href='../admin/users.php';</script>";
                
            }

            if (isset($_POST['changestatus'])) {

                $id = $_POST['id'];
                $status = $_POST['status'];
                
                $sql = "UPDATE users SET status = ? WHERE users_id = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$status,$id]);
           
                echo "<script type='text/javascript'>alert('Successfully Change Status');</script>";
                echo "<script>window.location.href='../admin/users.php';</script>";

            }

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
