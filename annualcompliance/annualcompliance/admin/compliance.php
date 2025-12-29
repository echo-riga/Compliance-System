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
          <h1>Compliance</h1>
        </section>

        <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <?php if($_SESSION['type'] == 0): ?>
                    <div class="box-header with-border">
                        <a href="#addnew" data-toggle="modal" class="btn btn-success btn-sm btn-flat custom-btn"><i class="fa fa-plus"></i> New Compliance</a> 
                    </div>
                <?php endif; ?>

                <?php if($_SESSION['type'] == 0): ?>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <th>List</th>
                                <th>Document</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php 
                                $sql = "SELECT * FROM compliance WHERE users_id = '".$_SESSION['users_id']."'";
                                $stmt = $this->conn()->query($sql);
                                $id = 1;
                                while ($row = $stmt->fetch()) { 
                                ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><a href="../files/<?php echo $row['file']; ?>" target="_blank"><?php echo $row['file']; ?></a></td>
                                        <td><span class="badge btn-warning"><?php echo $row['status']; ?></span></td>
                                        <td>
                                            <button class='btn btn-success btn-sm edit btn-flat' 
                                                data-edit_id='<?php echo $row['id']; ?>'>
                                                <i class='fa fa-edit'></i> Edit
                                            </button>
                                            <button class='btn btn-danger btn-sm delete btn-flat' 
                                                data-delete_id='<?php echo $row['id']; ?>'>
                                                <i class='fa fa-trash'></i> Delete
                                            </button>
                                            <?php if($_SESSION['type'] == 2): ?>
                                            <button class='btn btn-success btn-sm changestatus btn-flat' 
                                                data-changestatus_id='<?php echo $row['id']; ?>'>
                                                <i class='fa fa-edit'></i> Change Status
                                            </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php $id++; } ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

                <?php if($_SESSION['type'] == 2 || $_SESSION['type'] == 3): ?>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <th>List</th>
                                <th>Employee</th>
                                <th>Document</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php 

                                if ($_SESSION['type'] == 2) {
                                    $sql = "SELECT *,compliance.status AS c_status FROM compliance INNER JOIN users ON compliance.users_id=users.users_id WHERE compliance.status = 'Pending'";
                                } else if ($_SESSION['type'] == 3) {
                                    $sql = "SELECT *,compliance.status AS c_status FROM compliance INNER JOIN users ON compliance.users_id=users.users_id WHERE compliance.status = 'For Approval'";
                                }    
                                
                                $stmt = $this->conn()->query($sql);
                                $id = 1;
                                while ($row = $stmt->fetch()) { 
                                ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $row['lastname']; ?> <?php echo $row['firstname']; ?> <?php echo $row['middlename']; ?></td>
                                        <td><a href="../files/<?php echo $row['file']; ?>" target="_blank"><?php echo $row['file']; ?></a></td>
                                        <td><span class="badge btn-warning"><?php echo $row['c_status']; ?></span></td>
                                        <td>                                                
                                            <button class='btn btn-success btn-sm changestatus btn-flat' 
                                                data-changestatus_id='<?php echo $row['id']; ?>'>
                                                <i class='fa fa-edit'></i> Change Status
                                            </button>
                                        </td>
                                    </tr>
                                <?php $id++; } ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>


            </div>
          </div>
        </div>
      </section>
      </div>
    </div>
  <?php include 'footer.php'; ?>
  <?php include 'modal/complianceModal.php'; ?>
  <script>
    $(document).on('click', '.edit', function(e){
      e.preventDefault();
      $('#edit').modal('show');
      var edit_id = $(this).data('edit_id');

      $('#edit_id').val(edit_id)
    });

    $(document).on('click', '.changestatus', function(e){
      e.preventDefault();
      $('#changestatus').modal('show');
      var changestatus_id = $(this).data('changestatus_id');

      $('#changestatus_id').val(changestatus_id)
    });

    $(document).on('click', '.delete', function(e){
      e.preventDefault();

      $('#delete').modal('show');
      var delete_id = $(this).data('delete_id');
      
      $('#delete_id').val(delete_id)
    });

  </script>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>