<script src="asset/js/jquery.slim.min.js"></script>
<script src="asset/js/bootstrap.bundle.min.js"></script>
<script src="asset/js/fontawesome.js"></script>

<script>
  
document.getElementById('proof').addEventListener('change', function(){
      if (this.files[0] ) {
        var picture = new FileReader();
        picture.readAsDataURL(this.files[0]);
        picture.addEventListener('load', function(event) {
          document.getElementById('uploadedImage').setAttribute('src', event.target.result);
          document.getElementById('uploadedImage').style.display = 'block';
        });
        }
      });
    $('#submit').click(function(){
        alert('Please Login Required')
      })
   const rmCheck = document.getElementById("kmli"),
    emailInput = document.getElementById("email");
    passwordInput = document.getElementById("password-field");

  if (localStorage.checkbox && localStorage.checkbox !== "") {
    rmCheck.setAttribute("checked", "checked");
    emailInput.value = localStorage.username;
    passwordInput.value = localStorage.password;
  } else {
    rmCheck.removeAttribute("checked");
    emailInput.value = "";
    passwordInput.value = "";
  }

  function lsRememberMe() {
    if (rmCheck.checked && emailInput.value !== "" && passwordInput.value !== "") {
      localStorage.username = emailInput.value;
      localStorage.password = passwordInput.value;
      localStorage.checkbox = rmCheck.value;
    } else {
      localStorage.username = "";
      localStorage.checkbox = "";
    }
  }
  
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