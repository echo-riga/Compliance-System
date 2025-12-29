<?php
  include 'session.php';
  include '../config/config.php';
  class data extends Connection{ 
      public function managedata(){ 

?>
<!DOCTYPE html>
<html>
<head><?php include 'head.php'; ?></head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


<?php include 'navbar.php'; ?>
<?php include 'profile.php'; ?>
<?php include 'sidebar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1> 
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
          <div class="col-lg-4 col-12">
            <div class="small-box" style="color:#108a00;border-top: 3px solid rgba(0, 0, 0, 0.1);">
              <div class="inner">
                <h3><?php echo 1; ?></h3>

                <p>Total Employee</p>
              </div>
              <div class="icon">
                <i class="fas fa-users" style="color: #108a00;"></i>
              </div>
              <a href="employee.php" class="small-box-footer" style="background-color: #108a00;">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
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