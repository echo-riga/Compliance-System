<?php

    session_start();

date_default_timezone_set('Asia/Manila'); 

/***** Database Connection *****/
class Connection{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "annualcompliance";
    private $dsn;
    private $pdo;

    public function conn(){
        try {
        $this->dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname;
        $this->pdo = new PDO($this->dsn, $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $this->pdo->exec("SET time_zone = '+08:00'");
        
        return $this->pdo;          
        } catch (Exception $e) {
            echo 'error'. $e->getmessage();
        }

    }
}



    class controller extends Connection{

        public function managecontroller(){ 
         
            if (isset($_POST['fullname'])) {
                $fullname = $_POST['fullname'];

                $sql = "SELECT * FROM users WHERE fullname = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$fullname]);

                if ($stmt->rowCount() > 0) {
                    $row = $stmt->fetch();
                    $_SESSION['users_id'] = $row['users_id'];
                    $_SESSION['type'] = $row['type'];
                    echo json_encode(['status' => 'success']);
                } else {
                    echo json_encode(['status' => 'not_found']);
                }
            } else {
                echo json_encode(['status' => 'no_code']);
            } 

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
