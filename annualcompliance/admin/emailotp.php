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
                <form style="margin: auto;width: 400px;max-width: 100%;border: 1px solid rgba(0, 0, 0, 0.2);padding: 20px;border-radius: 10px;" method="POST" action="../controller/emailotpController.php">
                  <h1 style="font-weight: bold;text-align: center;">Email OTP</h1>
                  <br>
                  <div class="form-group">
                    <label>OTP Code*</label>
                    <div class="form-control pl-2 pr-2 p-0 d-flex" style="place-items:center;border: 2px solid rgba(0, 0, 0, 0.2);border-radius: 8px;">
                      <input type="text" name="code" placeholder="OTP Code" class="rounded w-100 h-100 border-0 bg-transparent" style="outline: none;">
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <div class="form-control p-0 border-0">
                      <input type="submit" name="emailotp" class="signin btn-lg text-white w-100 border-0" value="Submit" style="outline: none;background-color: #003067;border-radius: 8px;">
                    </div>
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
