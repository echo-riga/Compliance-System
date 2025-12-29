<?php

    session_start();
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){ 
    
?>

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
        <div class="col-lg-7 m-auto p-0">
          <div class="card bg-transparent p-3 border-0" style="height: 90vh; display: grid; place-items: center;">
                <form style="margin: auto;width: 400px;max-width: 100%;border: 1px solid rgba(0, 0, 0, 0.2);padding: 20px;border-radius: 10px;" method="POST" action="../controller/passphraseController.php">
              <h3 style="font-weight: bold; text-align: center;">Passphrase Key Word!</h3>
              <br>
              <div class="form-group">
                <label>Passphrase*</label>
                  <input type="hidden" name="passphrase" class="passphrase-input">
                  <div class="form-control pl-2 pr-2 p-2 d-flex flex-wrap align-items-start" style="border: 2px solid rgba(0, 0, 0, 0.2); border-radius: 8px; height: 200px;">
                    <div class="passphrase form-control pl-2 pr-2 p-2 d-flex flex-wrap align-items-start border-0">
                    </div>
                  </div>
              </div>
              <br>
              <div class="form-group">
                <div class="form-control p-0 border-0 text-center">
                 <?php
                    $passphrase = $_SESSION['passphrase'];
                    $words = explode('-', $passphrase);
                    shuffle($words);

                    foreach ($words as $word) {
                        echo "<button type='button' class='btn-sm mt-1 btn-success text-white border-0' onclick=\"handleClick('$word', this)\">$word</button> ";
                    }
                  ?>
                </div>
              </div>
              <br>
              <div class="form-group">
                <div class="form-control p-0 border-0">
                  <input type="submit" name="login" class="signin btn-lg text-white w-100 border-0" value="Submit" style="outline: none;background-color: #0000FF;border-radius: 8px;">
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

   <script>
function handleClick(word, button) {
    const container = document.querySelector('.passphrase'); // Correctly selecting the div to append the word
    const input = document.querySelector('.passphrase-input'); // Correctly selecting the input to append word in it

    // Create a new span for the word
    const tag = document.createElement('span');
    tag.className = 'word-tag';
    tag.textContent = word;

    // Check if container already has content
    if (container.children.length > 0) {
        // If there's content, add a dash between the existing words
        const dash = document.createElement('span');
        dash.textContent = '-';
        dash.className = 'word-tag dash';  // Apply special style if needed for dash
        container.appendChild(dash);
    }
    container.appendChild(tag);

    // Add word to the input
    if (input.value.trim() === '') {
        input.value = word;
    } else {
        input.value += '-' + word;
    }

    // Hide the button after click
    button.style.display = 'none';
}

</script>


  </body>
</html>
<?php

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
