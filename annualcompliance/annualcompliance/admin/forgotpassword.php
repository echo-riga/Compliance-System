
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
                <form style="margin: auto;width: 400px;max-width: 100%;border: 1px solid rgba(0, 0, 0, 0.2);padding: 20px;border-radius: 10px;" method="POST" action="../controller/forgotpasswordController.php">
                  <h2 class="title_signin mt-4" style="color: #0d528a;"><img src="../images/logo.png" width="100px"> Forgot Password</h2>
                  <br>
                  <div class="form-group">
                    <label>Email*</label>
                    <div class="form-control pl-2 pr-2 p-0 d-flex" style="place-items:center;border: 2px solid rgba(0, 0, 0, 0.2);border-radius: 8px;">
                      <input type="text" name="email" id="email" placeholder="Email" class="rounded w-100 h-100 border-0 bg-transparent" style="outline: none;">
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <div class="form-control p-0 border-0">
                      <input type="submit" name="forgotpassword" class="btn-lg text-white w-100 border-0" value="Send Email" style="outline: none;background-color: #0000FF;border-radius: 8px;" onclick="lsRememberMe()">
                    </div>
                    <br>
                  </div>
                </form>
              </div>
        </div>
      </div>
    </div>

    <script src="../asset/js/jquery.slim.min.js"></script>
    <script src="../asset/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/js/fontawesome.js"></script>
  </body>
</html>