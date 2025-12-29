<?php
  include 'session.php';
  include '../config/config.php';
  class data extends Connection{ 
      public function managedata(){ 

        $sql = "SELECT COUNT(users_id) AS totalEmployee FROM users WHERE type = 0";  
        $stmt = $this->conn()->query($sql);
        $row = $stmt->fetch();
        $totalEmployee = $row['totalEmployee'];

        $sql = "SELECT COUNT(id) AS totalDocument FROM compliance";  
        $stmt = $this->conn()->query($sql);
        $row = $stmt->fetch();
        $totalDocument = $row['totalDocument'];


        $sql = "SELECT COUNT(id) AS totalSaln FROM compliance WHERE category = 'SALN' AND status = 'Approved'";  
        $stmt = $this->conn()->query($sql);
        $row = $stmt->fetch();
        $totalSaln = $row['totalSaln'];

        $sql = "SELECT COUNT(id) AS totalApe FROM compliance WHERE category = 'APE' AND status = 'Approved'";  
        $stmt = $this->conn()->query($sql);
        $row = $stmt->fetch();
        $totalApe = $row['totalApe'];

        $sql = "SELECT COUNT(id) AS totalCtc FROM compliance WHERE category = 'CTC' AND status = 'Approved'";  
        $stmt = $this->conn()->query($sql);
        $row = $stmt->fetch();
        $totalCtc = $row['totalCtc'];

        $sql = "SELECT COUNT(id) AS totalItr FROM compliance WHERE category = 'ITR' AND status = 'Approved'";  
        $stmt = $this->conn()->query($sql);
        $row = $stmt->fetch();
        $totalItr = $row['totalItr'];

        $sql = "SELECT COUNT(id) AS totalPds FROM compliance WHERE category = 'PDS' AND status = 'Approved'";  
        $stmt = $this->conn()->query($sql);
        $row = $stmt->fetch();
        $totalPds = $row['totalPds'];

?>
<!DOCTYPE html>
<html>
<head><?php include 'head.php'; ?></head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


<?php include 'navbar.php'; ?>
<?php include 'profile.php'; ?>
<?php include 'sidebar.php'; ?>

  <div class="content-wrapper" style="background-image: url(../images/bg.jpeg);background-repeat: no-repeat;background-size: cover;">
    <section class="content-header">
      <h1 style="color: #fff;"> 
        Welcome 
        <?php 
        if ($_SESSION['type'] == 1) { 
          echo "Admin!";
        } else if ($_SESSION['type'] == 2) { 
          echo "HR Staff!";
        } else if ($_SESSION['type'] == 3) { 
          echo "HR Officer!";
        } else {
          echo "Employee";
        }
        ?>
      </h1>
    </section>

    <section class="content">
      <div class="row">
        <?php if ($_SESSION['type'] != 0) { ?>
          <div class="col-lg-4 col-12">
            <div class="small-box" style="background-color: #fff;color:#003067;border-top: 3px solid rgba(0, 0, 0, 0.1);border-top: unset;">
              <div class="inner">
                <h3><?php echo $totalEmployee; ?></h3>

                <p>Total Employee</p>
              </div>
              <div class="icon">
                <i class="fas fa-users" style="color: #003067;"></i>
              </div>
              <a href="employee.php" class="small-box-footer" style="background-color: #003067;">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-12">
            <div class="small-box" style="background-color: #fff;color:#003067;border-top: 3px solid rgba(0, 0, 0, 0.1);border-top: unset;">
              <div class="inner">
                <h3><?php echo $totalDocument; ?></h3>

                <p>Total Document</p>
              </div>
              <div class="icon">
                <i class="fas fa-users" style="color: #003067;"></i>
              </div>
              <a href="compliance.php" class="small-box-footer" style="background-color: #003067;">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-8 col-12">
            <h2>Files</h2>
            <div class="row">
              <div class="col-lg-3 col-12">
                <a href="compliance.php?category=SALN">
                  <div class="small-box" style="background-color: #fff;color:#003067;border-top: 3px solid rgba(0, 0, 0, 0.1);border-top: unset;">
                    <div class="inner">
                        <i class="fas fa-list" style="color: #003067;font-size: 25px;"></i>
                      <h3>SALN</h3>
                      <p style="font-size: 18px;font-weight: bold;"><?php echo $totalSaln; ?></p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-lg-3 col-12">
                <a href="compliance.php?category=APE">
                  <div class="small-box" style="background-color: #fff;color:#003067;border-top: 3px solid rgba(0, 0, 0, 0.1);border-top: unset;">
                    <div class="inner">
                        <i class="fas fa-list" style="color: #003067;font-size: 25px;"></i>
                      <h3>APE</h3>
                      <p style="font-size: 18px;font-weight: bold;"><?php echo $totalApe; ?></p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-lg-3 col-12">
                <a href="compliance.php?category=CTC">
                  <div class="small-box" style="background-color: #fff;color:#003067;border-top: 3px solid rgba(0, 0, 0, 0.1);border-top: unset;">
                    <div class="inner">
                        <i class="fas fa-list" style="color: #003067;font-size: 25px;"></i>
                      <h3>CTC</h3>
                      <p style="font-size: 18px;font-weight: bold;"><?php echo $totalCtc; ?></p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-lg-3 col-12">
                <a href="compliance.php?category=ITR">
                  <div class="small-box" style="background-color: #fff;color:#003067;border-top: 3px solid rgba(0, 0, 0, 0.1);border-top: unset;">
                    <div class="inner">
                        <i class="fas fa-list" style="color: #003067;font-size: 25px;"></i>
                      <h3>ITR</h3>
                      <p style="font-size: 18px;font-weight: bold;"><?php echo $totalItr; ?></p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-lg-3 col-12">
                <a href="compliance.php?category=PDS">
                  <div class="small-box" style="background-color: #fff;color:#003067;border-top: 3px solid rgba(0, 0, 0, 0.1);border-top: unset;">
                    <div class="inner">
                        <i class="fas fa-list" style="color: #003067;font-size: 25px;"></i>
                      <h3>PDS</h3>
                      <p style="font-size: 18px;font-weight: bold;"><?php echo $totalPds; ?></p>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>

        <?php } ?>

          <?php
          if ($_SESSION['type'] == 0) {
            $sql = "SELECT * FROM compliance WHERE users_id = '".$_SESSION['users_id']."' ORDER BY id DESC LIMIT 1";  
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch();
          ?>
            <div class="col-lg-12 col-12">
              <div class="small-box" style="color:#003067;border-top: 3px solid rgba(0, 0, 0, 0.1);">
                <div class="inner" style="background-color: white;">
                  <h2>
                    <?php
                    if ($stmt->rowCount() > 0){
                    if ($row['status'] == 'Pending') {
                      echo "Your document file is handled by HR staff.";
                    } else if ($row['status'] == 'For Approval') {
                      echo "Your document file is handled by HR Officer.";
                    } else {
                      echo "Your document file is handled by Admin.";
                    }
                    }
                    ?>
                   </h2>
                   <h2>
                    <a href="../files/<?php echo $row['file']; ?>" target="_blank">Check File Here</a>
                   </h2>
                </div>
              </div>
            </div>
          <?php } ?>
          <!-- <div class="col-lg-4 col-12">
            <div class="small-box" style="color:#108a00;border-top: 3px solid rgba(0, 0, 0, 0.1);">
              <div class="inner">
                <h3><?php echo number_format($dailyincome,2); ?></h3>

                <p>Daily Income</p>
              </div>
              <div class="icon">
                <i class="fas fa-money-check" style="color: #108a00;"></i>
              </div>
              <a href="report.php" class="small-box-footer" style="background-color: #108a00;">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-12">
            <div class="small-box" style="color:#108a00;border-top: 3px solid rgba(0, 0, 0, 0.1);">
              <div class="inner">
                <h3><?php echo number_format($totalrevenue,2); ?></h3>

                <p>Total Revenue</p>
              </div>
              <div class="icon">
                <i class="fas fa-money-check" style="color: #108a00;"></i>
              </div>
              <a href="report.php" class="small-box-footer" style="background-color: #108a00;">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->

        </div>
    </section>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>