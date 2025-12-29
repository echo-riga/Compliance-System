<link rel="stylesheet" type="text/css" href="../dist/css/style.css">
<aside class="main-sidebar" style="overflow-y: auto;bottom: 0;">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header" style="background-color: #fff;color: #0000FF;text-align: center;font-size: 26px;padding-bottom: 20px;">
        <img src="../images/logo.png" width="100px">
        <h3 style="font-weight: bold;margin: unset;">Annual Compliance</h3>
      </li>

      <li><a href="dashboard.php"><i class="fas fa-dashboard"></i> <span> Dashboard</span></a></li>
      <?php if ($_SESSION['type'] == 1) { ?>
        <li><a href="employee.php"><i class="fas fa-users"></i> <span> Employee</span></a></li>
      <?php } ?>

      <?php if($_SESSION['type'] != 1){ ?>
        <li><a href="compliance.php"><i class="fas fa-list"></i> <span> Compliance</span></a></li>
      <?php } ?>

      <?php if ($_SESSION['type'] == 1) { ?>
        <li><a href="approved.php"><i class="fas fa-list"></i> <span> Approved</span></a></li>
        <li><a href="declined.php"><i class="fas fa-list"></i> <span> Disapproved</span></a></li>
      <?php } ?>

      <?php if ($_SESSION['type'] == 1) { ?>
        <li><a href="audittrail.php"><i class="fas fa-history"></i> <span> Audit Trail</span></a></li>
      <?php } ?>

    </ul>
  </section>
</aside>
