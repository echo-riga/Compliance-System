<?php
session_start();
include '../config/config.php';

class controller extends Connection{
    public function managecontroller(){ 
        if (isset($_POST['login'])) {
            $currentdatetime = date('Y-m-d H:i:s');
            unset($_SESSION['passphrase']);

            $employeeid = $_POST['employeeid'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM users WHERE employeeid = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$employeeid]);

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();

                // Check if account is locked
                if (!empty($row['datetime']) && $row['datetime'] >= $currentdatetime) {
                    echo "<script type='text/javascript'>alert('Too many attempts. Please try again later');</script>";
                    echo "<script>window.location.href='../admin/index.php';</script>";
                    return;
                }

                // FIX: Compare against passwordtxt instead of password
                if ($password === $row['passwordtxt']) {
                    $_SESSION['passphrase'] = $row['passphrase'];

                    if ($row['status'] == 1) {
                        // Reset attempt counter
                        $sql = "UPDATE users SET attempt = 0, datetime = NULL WHERE employeeid = ?";
                        $stmt = $this->conn()->prepare($sql);
                        $stmt->execute([$employeeid]);

                        $_SESSION['users_id'] = $row['users_id'];
                        header('Location: ../admin/otpoption.php');
                        exit();
                    } else {
                        echo "<script type='text/javascript'>alert('Waiting for Account Approval');</script>";
                        echo "<script>window.location.href='../admin/index.php';</script>";
                    }
                } else {
                    // Handle failed login attempt
                    $attempt = $row['attempt'] + 1;

                    if ($attempt >= 4) {
                        $datetime = date('Y-m-d H:i:s', strtotime('+1 hour'));
                        $sql = "UPDATE users SET attempt = ?, datetime = ? WHERE employeeid = ?";
                        $stmt = $this->conn()->prepare($sql);
                        $stmt->execute([$attempt, $datetime, $employeeid]);
                    } else {
                        $sql = "UPDATE users SET attempt = ? WHERE employeeid = ?";
                        $stmt = $this->conn()->prepare($sql);
                        $stmt->execute([$attempt, $employeeid]);
                    }

                    echo "<script type='text/javascript'>alert('Invalid Employee ID or Password');</script>";
                    echo "<script>window.location.href='../admin/index.php';</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('Invalid Employee ID or Password');</script>";
                echo "<script>window.location.href='../admin/index.php';</script>";
            }
        }
    }
}

$controllerrun = new controller();
$controllerrun->managecontroller();
?>