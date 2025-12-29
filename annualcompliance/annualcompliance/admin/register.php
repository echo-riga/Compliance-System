
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="../asset/css/bootstrap.min.css">
<link rel="stylesheet" href="../asset/css/login.css">

<title>Monitoring of Pasig City Employees Annual Compliance</title>

  </head>
  <body>
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div style="" class="col-lg-7 m-auto p-0">
              <div class="card bg-transparent p-3 border-0"  style="height: 90vh;display: grid;place-items: center;">
                <form style="margin: auto;width: 400px;max-width: 100%;border: 1px solid rgba(0, 0, 0, 0.2);padding: 20px;border-radius: 10px;" method="POST" action="../controller/registerController.php">
                  <h1 class="title_signin mt-4" style="color: #0d528a;text-align: center;"><img src="../images/logo.png" width="150px"> Register</h1>
              <!--     <h3>Hello</h3>
                  <h1 style="font-weight: bold;">Welcome!</h1> -->
                  <br>
                  <div class="form-group">
                    <label>Employee ID*</label>
                    <div class="form-control pl-2 pr-2 p-0 d-flex" style="place-items:center;border: 2px solid rgba(0, 0, 0, 0.2);border-radius: 8px;">
                      <input type="text" name="employeeid" placeholder="Employee ID" class="rounded w-100 h-100 border-0 bg-transparent" style="outline: none;" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>First Name*</label>
                    <div class="form-control pl-2 pr-2 p-0 d-flex" style="place-items:center;border: 2px solid rgba(0, 0, 0, 0.2);border-radius: 8px;">
                      <input type="text" name="firstname" placeholder="First Name" class="rounded w-100 h-100 border-0 bg-transparent" style="outline: none;" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Last Name*</label>
                    <div class="form-control pl-2 pr-2 p-0 d-flex" style="place-items:center;border: 2px solid rgba(0, 0, 0, 0.2);border-radius: 8px;">
                      <input type="text" name="lastname" placeholder="Last Name" class="rounded w-100 h-100 border-0 bg-transparent" style="outline: none;" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Middle Name*</label>
                    <div class="form-control pl-2 pr-2 p-0 d-flex" style="place-items:center;border: 2px solid rgba(0, 0, 0, 0.2);border-radius: 8px;">
                      <input type="text" name="middlename" placeholder="Middle Name" class="rounded w-100 h-100 border-0 bg-transparent" style="outline: none;" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Email*</label>
                    <div class="form-control pl-2 pr-2 p-0 d-flex" style="place-items:center;border: 2px solid rgba(0, 0, 0, 0.2);border-radius: 8px;">
                      <input type="email" name="email" id="email" placeholder="Email" class="rounded w-100 h-100 border-0 bg-transparent" style="outline: none;" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Password*</label>
                    <div class="form-control pl-2 pr-2 p-0 d-flex" style="place-items:center;border: 2px solid rgba(0, 0, 0, 0.2);border-radius: 8px;">
                      <input id="password-field" type="password" name="password" placeholder="********" class="rounded w-100 h-100 border-0 bg-transparent" style="outline: none;" required>
                      <i toggle="#password-field" class="fas fa-eye text-muted toggle-password"></i>
                    </div>
                    <small id="password-strength-msg" class="text-muted">Required: min 8 chars, uppercase, number, symbol</small>
                  </div>
                  <div class="form-group">
                    <label>Status Of Employment*</label>
                    <div class="form-control pl-2 pr-2 p-0 d-flex" style="place-items:center;border: 2px solid rgba(0, 0, 0, 0.2);border-radius: 8px;">
                      <select name="status_of_employment" class="rounded w-100 h-100 border-0 bg-transparent" style="outline: none;" required>
                        <option value="Job order">Job order</option>
                        <option value="Casual">Casual</option>
                        <option value="Permanent">Permanent</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-control p-0 border-0">
                      <input type="submit" name="register" class="signin registerbtn btn-lg text-white w-100 border-0" value="Register" style="outline: none;background-color: #0000FF;border-radius: 8px;" onclick="lsRememberMe()" disabled>
                    </div>
                    <br>
                    <p style="text-align: center;">You have already an account? <a href="index.php">Login?</a></p>
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
    </script>
    <script>
      $(document).ready(function () {
        // Toggle show/hide password
  

        // Password strength checker
        $('#password-field').on('input', function () {
          let val = $(this).val();
          let strengthMsg = $('#password-strength-msg');

          // RegEx for password strength
          let strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[^A-Za-z0-9]).{8,}$");
          let mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*\\d))).{6,}$");

          if (val.length === 0) {
            strengthMsg.text("Required: min 8 chars, uppercase, number, symbol").removeClass().addClass("text-muted");
            $('.registerbtn').attr('disabled', true)
          } else if (strongRegex.test(val)) {
            strengthMsg.text("Strong password").removeClass().addClass("text-success");
            $('.registerbtn').attr('disabled', false)
          } else if (mediumRegex.test(val)) {
            strengthMsg.text("Medium strength (add more symbols/uppercase)").removeClass().addClass("text-warning");
            $('.registerbtn').attr('disabled', true)
          } else {
            strengthMsg.text("Weak password").removeClass().addClass("text-danger");
            $('.registerbtn').attr('disabled', true)
          }
        });
      });
      </script>
  </body>
</html>