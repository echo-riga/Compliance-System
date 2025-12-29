
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
                <form style="margin: auto;width: 400px;max-width: 100%;border: 1px solid rgba(0, 0, 0, 0.2);padding: 20px;border-radius: 10px;" method="POST" action="../controller/loginController.php">
                  <h1 class="title_signin mt-4" style="color: #003067;text-align: center;"><img src="../images/logo.png" width="150px"> Log In</h1>
               <!--    <h3>Hello</h3>
                  <h1 style="font-weight: bold;">Welcome!</h1> -->
                  <br>
                  <div class="form-group">
                    <label>Employee ID*</label>
                    <div class="form-control pl-2 pr-2 p-0 d-flex" style="place-items:center;border: 2px solid rgba(0, 0, 0, 0.2);border-radius: 8px;">
                      <input type="text" name="employeeid" id="email" placeholder="Employee ID" class="rounded w-100 h-100 border-0 bg-transparent" style="outline: none;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Password*</label>
                    <div class="form-control pl-2 pr-2 p-0 d-flex" style="place-items:center;border: 2px solid rgba(0, 0, 0, 0.2);border-radius: 8px;">
                      <input id="password-field" type="password" name="password" placeholder="********" class="rounded w-100 h-100 border-0 bg-transparent" style="outline: none;">
                      <i toggle="#password-field" class="fas fa-eye text-muted toggle-password"></i>
                    </div>
                  </div>
                  <div>
                    <input type="checkbox" required>
                    <a href="#privacypolicy" data-toggle="modal"><small>Terms & Condition</small></a> 
                  </div>

                  <br>
                  <div class="form-group">
                    <div class="form-control p-0 border-0">
                      <input type="submit" name="login" class="signin btn-lg text-white w-100 border-0" value="Login" style="outline: none;background-color: #003067;border-radius: 8px;" onclick="lsRememberMe()">
                    </div>
                    <br>
                    <!-- <p style="text-align: center;">You don't have an account? <a href="register.php">Register?</a></p> -->
                    <p style="text-align: center;"><a href="forgotpassword.php" class="text-decoration-none text-dark">Forgot Password?</a></p>
                    <p style="text-align: center;"><a href="facerecognitionweb/facescan/scan.php" class="text-decoration-none text-dark">Face Scan?</a></p>
                  </div>
                </form>
              </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="privacypolicy">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title text-start"><b>Terms & Condition</b></h4>
                </div>
                <div class="modal-body">
                  <p>This system collects and processes personal information as part of the <strong>Annual Compliance</strong> procedure...</p>
                  <ul>
                    <li><strong>Information We Collect:</strong> Name, contact details, etc.</li>
                    <li><strong>Purpose:</strong> For compliance verification only.</li>
                    <li><strong>Data Usage:</strong> Stored securely, accessed by authorized personnel.</li>
                    <li><strong>Sharing:</strong> Not shared unless required by law.</li>
                    <li><strong>Retention:</strong> Kept only as long as necessary.</li>
                    <li><strong>Your Rights:</strong> Access, correct, or delete your data upon request.</li>
                  </ul>
                  <p>By proceeding, you acknowledge that you have read and understood this Privacy Policy.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
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
  </body>
</html>