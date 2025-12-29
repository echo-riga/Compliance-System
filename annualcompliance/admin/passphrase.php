<?php session_start(); 

if (!isset($_SESSION['passphrase'])) {
  header('location: index.php');
}

?>
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
        <div class="col-lg-7 m-auto p-0">
          <div class="card bg-transparent p-3 border-0" style="height: 90vh; display: grid; place-items: center;">
            <form style="margin: auto; width: 400px; max-width: 100%; border: 1px solid rgba(0, 0, 0, 0.2); padding: 20px; border-radius: 10px;">
              <h3 style="font-weight: bold; text-align: center;">Passphrase Key Word!</h3>
              <br>
              <div class="form-group">
                <label>Passphrase*</label>
                <div id="passphrase" class="form-control pl-2 pr-2 p-0 d-flex" style="border: 2px solid rgba(0, 0, 0, 0.2); border-radius: 8px; height: 200px;">
                  <?php if(isset($_SESSION['passphrase'])): echo $_SESSION['passphrase']; endif; ?>
                </div>
              </div>
              <br>
              <div class="form-group">
                <div class="form-control p-0 border-0">
                  <input type="button" class="signin btn-lg text-white w-100 border-0" id="downloadBtn" value="Download" style="outline: none; background-color: #108a00; border-radius: 8px;">
                </div>
                <br>
                <p style="text-align: center;">Click here to login <a href="index.php">Login?</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.getElementById('downloadBtn').addEventListener('click', function () {
        const passphrase = document.getElementById('passphrase').innerText.trim();
        const blob = new Blob([passphrase], { type: 'text/plain' });
        const link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = 'passphrase.txt';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      });
    </script>

    <script src="../asset/js/jquery.slim.min.js"></script>
    <script src="../asset/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/js/fontawesome.js"></script>
  </body>
</html>
