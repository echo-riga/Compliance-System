<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="../asset/css/bootstrap.min.css">
<link rel="stylesheet" href="../asset/css/login.css">

<title>Pasig City Employee Compliance System</title>

  </head>
  <body>
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div style="" class="col-lg-7 m-auto p-0">
              <div class="card bg-transparent p-3 border-0"  style="height: 90vh;display: grid;place-items: center;">
                <form style="margin: auto;width: 400px;max-width: 100%;border: 1px solid rgba(0, 0, 0, 0.2);padding: 20px;border-radius: 10px;" method="POST" action="../controller/changepasswordController.php">
                  <h3 class="title_signin mt-4" style="color: #003067;text-align: center;">
                    <img src="../images/logo.png" width="100px"> <br>Change Password</h3>
                  <br><br>
                  <input type="hidden" name="code" value="<?php echo $_GET['code'] ?>">
                  <div class="form-group">
                    <label><?php echo $_SESSION['questionnaire']; ?>*</label>
                    <div class="form-control pl-2 pr-2 p-0 d-flex" style="place-items:center;border: 2px solid rgba(0, 0, 0, 0.2);border-radius: 8px;">
                      <input type="text" name="answer" class="rounded w-100 h-100 border-0 bg-transparent" style="outline: none;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Password*</label>
                    <div class="form-control pl-2 pr-2 p-0 d-flex" style="place-items:center;border: 2px solid rgba(0, 0, 0, 0.2);border-radius: 8px;">
                      <input type="password" name="password" id="password" class="rounded w-100 h-100 border-0 bg-transparent" style="outline: none;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Confirm Password*</label>
                    <div class="form-control pl-2 pr-2 p-0 d-flex" style="place-items:center;border: 2px solid rgba(0, 0, 0, 0.2);border-radius: 8px;">
                      <input type="password" name="confirmpassword" id="confirmpassword" class="rounded w-100 h-100 border-0 bg-transparent" style="outline: none;">
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <div class="form-control p-0 border-0">
                      <input type="submit" name="changepassword" class="btn-lg text-white w-100 border-0" value="Change Password" style="outline: none;background-color: #003067;border-radius: 8px;" onclick="lsRememberMe()">
                    </div>
                    <br>
                    <!-- <a style="color: #000;" href="forgotpassword.php">Forgot Password?</a> -->
                  </div>
                </form>
              </div>
        </div>
      </div>
    </div>

    <script src="../asset/js/jquery.slim.min.js"></script>
    <script src="../asset/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/js/fontawesome.js"></script>
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
    </script>>
  </body>
</html>