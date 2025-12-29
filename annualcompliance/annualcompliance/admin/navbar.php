
<header class="main-header">
  <!-- Logo -->
<!--   <a href="#" class="logo">

    EVALUATION SYSTEM
  </a> -->
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             <?php
          $sql = "SELECT * FROM users WHERE users_id = '".$_SESSION['users_id']."'";
          $stmt = $this->conn()->query($sql);
          $row = $stmt->fetch();
                ?>
            <img src="../images/<?php echo $row['img'] ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="../images/<?php echo $row['img'] ?>" class="img-circle" alt="User Image">

              <p>
                <?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="#profile" data-toggle="modal" class="btn btn-default btn-flat" id="admin_profile" 
                data-user_id="<?php echo $_SESSION['users_id'] ?>" 
                data-firstname="<?php echo $row['firstname'] ?>" 
                data-lastname="<?php echo $row['lastname'] ?>" 
                data-middlename="<?php echo $row['middlename'] ?>" 
                data-address="<?php echo $row['address'] ?>" 
                data-email="<?php echo $row['email'] ?>" 
                data-contact="<?php echo $row['contact'] ?>" 
                data-password="<?php echo $row['passwordtxt'] ?>"
                data-questionnaire="<?php echo $row['questionnaire'] ?>"
                data-answer="<?php echo $row['answer'] ?>">Update</a>
              </div>
              <div class="pull-right">
                <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>