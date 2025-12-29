<?php 
  session_start();
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
          <h1>Approved Compliance</h1>
        </section>

        <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <th>List</th>
                                <th>Employee</th>
                                <th>Document</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                <?php 
                                $sql = "SELECT *,compliance.status AS c_status FROM compliance INNER JOIN users ON compliance.users_id=users.users_id WHERE compliance.status = 'Approved'";
                                $stmt = $this->conn()->query($sql);
                                $id = 1;
                                while ($row = $stmt->fetch()) { 
                                ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $row['lastname']; ?> <?php echo $row['firstname']; ?> <?php echo $row['middlename']; ?></td>
                                        <td><a href="../files/<?php echo $row['file']; ?>" target="_blank"><?php echo $row['file']; ?></a></td>
                                        <td>
                                            <span class="badge btn-success"><?php echo $row['c_status']; ?></span>
                                        </td>
                                    </tr>
                                <?php $id++; } ?>
                            </tbody>
                        </table>
                    </div>
            </div>
          </div>
        </div>
      </section>
      </div>
    </div>
  <?php include 'footer.php'; ?>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>