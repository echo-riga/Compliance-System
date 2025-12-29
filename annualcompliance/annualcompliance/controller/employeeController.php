<?php

    include '../config/config.php';
    session_start();
    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['edit'])) {

                $id = $_POST['id'];
                $status = $_POST['status'];
                
                $sql = "UPDATE users SET status = ? WHERE users_id = '".$id."'";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$status]);

                echo "<script type='text/javascript'>alert('Successfully Update Status');</script>";
                echo "<script>window.location.href='../admin/employee.php';</script>";
                
            }


        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
