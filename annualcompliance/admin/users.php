<?php
  include 'session.php';
  include '../config/config.php';
  class data extends Connection{ 
      public function managedata(){ 
        $sql = "SELECT * FROM users WHERE type = 0";
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
          <h1>Account Employee</h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Account Employee</li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header with-border">
                    <a href="#addnew" data-toggle="modal" class="btn btn-success btn-sm btn-flat custom-btn"><i class="fa fa-plus"></i> New Employee Account</a> 
                </div>
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
                          <td>
                            <?php if($row['status'] == 0): ?>
                            <button class='btn btn-success btn-sm edit btn-flat' 
                              data-edit_users_id='<?php echo $row['users_id'] ?>'> Change Status</button>
                            <?php endif; ?>
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
    <script src="../asset/js/fontawesome.js"></script>
    <?php include 'modal/usersModal.php'; ?>
    <script>
      $(document).on('click', '.edit', function(e){
        e.preventDefault();
        $('#edit').modal('show');
        var edit_users_id = $(this).data('edit_users_id');

        $('#edit_id').val(edit_users_id)
      });

    </script>

    <script type="text/javascript">
      $(".toggle-password").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
          input.attr("type", "text");
      }else{
        input.attr("type", "password");
      }
  });

      $(".toggle-password2").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
          input.attr("type", "text");
      }else{
        input.attr("type", "password");
      }
  });
    </script>
    <script>
      $(document).ready(function () {
        // Toggle show/hide password
  

        // Password strength checker
        // $('#password-field').on('input', function () {
        //   let val = $(this).val();
        //   let strengthMsg = $('#password-strength-msg');

        //   // RegEx for password strength
        //   let strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[^A-Za-z0-9]).{8,}$");
        //   let mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*\\d))).{6,}$");

        //   if (val.length === 0) {
        //     strengthMsg.text("Required: min 8 chars, uppercase, number, symbol").removeClass().addClass("text-muted");
        //     $('.registerbtn').attr('disabled', true)
        //   } else if (strongRegex.test(val)) {
        //     strengthMsg.text("Strong password").removeClass().addClass("text-success");
        //     $('.registerbtn').attr('disabled', false)
        //   } else if (mediumRegex.test(val)) {
        //     strengthMsg.text("Medium strength (add more symbols/uppercase)").removeClass().addClass("text-warning");
        //     $('.registerbtn').attr('disabled', true)
        //   } else {
        //     strengthMsg.text("Weak password").removeClass().addClass("text-danger");
        //     $('.registerbtn').attr('disabled', true)
        //   }
        // });

        // $('#password-field2').on('input', function () {
        //   let val = $(this).val();
        //   let strengthMsg = $('#password-strength-msg2');

        //   // RegEx for password strength
        //   let strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[^A-Za-z0-9]).{8,}$");
        //   let mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*\\d))).{6,}$");

        //   if (val.length === 0) {
        //     strengthMsg.text("Required: min 8 chars, uppercase, number, symbol").removeClass().addClass("text-muted");
        //     $('.registerbtn').attr('disabled', true)
        //   } else if (strongRegex.test(val)) {
        //     strengthMsg.text("Strong password").removeClass().addClass("text-success");
        //     $('.registerbtn').attr('disabled', false)
        //   } else if (mediumRegex.test(val)) {
        //     strengthMsg.text("Medium strength (add more symbols/uppercase)").removeClass().addClass("text-warning");
        //     $('.registerbtn').attr('disabled', true)
        //   } else {
        //     strengthMsg.text("Weak password").removeClass().addClass("text-danger");
        //     $('.registerbtn').attr('disabled', true)
        //   }
        // });
      });
      </script>
  </body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>