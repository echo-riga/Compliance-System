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
                <form style="margin: auto;width: 400px;max-width: 100%;padding: 20px;" method="POST" action="../controller/loginController.php">
                  <h1 style="font-weight: bold;text-align: center;">Select Otp Option</h1>
                  <br>
                  <div class="form-group">
                    <div class="form-control p-0 border-0" style="outline: none;background-color: #c0c0c0;border-radius: 8px;text-align: center;align-content: center;">
                      <a href="../controller/sendemailotpController.php" class="btn-lg text-white w-100 text-decoration-none"><img src="../images/gmail.png" width="20px"> Via Email</a>
                    </div>
                  <!--   <br>
                    <div class="form-control p-0 border-0" style="outline: none;background-color: #c0c0c0;border-radius: 8px;text-align: center;align-content: center;">
                      <a href="facerecognitionweb/facescan/scan.php" class="btn-lg text-white w-100 text-decoration-none"><img src="../images/facescan.png" width="20px"> Face Scan</a>
                    </div> -->
                    <br>
                    <!-- <div class="form-control p-0 border-0" style="outline: none;background-color: #c0c0c0;border-radius: 8px;text-align: center;align-content: center;">
                      <a href="passphrasekeyword.php" class="btn-lg text-white w-100 text-decoration-none"><img src="../images/passphrase.png" width="20px"> Passphrase Key Word</a>
                    </div> -->
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