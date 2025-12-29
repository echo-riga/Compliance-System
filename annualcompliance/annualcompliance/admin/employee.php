<?php
  include 'session.php';
  include '../config/config.php';
  class data extends Connection{ 
      public function managedata(){ 
        $sql = "SELECT * FROM users WHERE status = 0";
        $stmtusers = $this->conn()->query($sql);
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
          <h1>Employee</h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Employee</li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <th>#</th>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th>Action</th>
                    </thead>
                    <tbody>


                      <?php
                      $id = 1;
                      while ($row = $stmtusers->fetch()) { ?>

                        <tr>
                          <td><?php echo $id; ?></td>
                          <td><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></td>
                          <td><?php echo $row['email'] ?></td>
                          <td><button class='btn btn-success btn-sm edit btn-flat' 
                              data-edit_users_id='<?php echo $row['users_id'] ?>'> Change Status</button></td>
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
    <?php include 'modal/employeeModal.php'; ?>
    <script>
      $(document).on('click', '.edit', function(e){
        e.preventDefault();
        $('#edit').modal('show');
        var edit_users_id = $(this).data('edit_users_id');

        $('#edit_id').val(edit_users_id)
      });

    </script>
  </body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>