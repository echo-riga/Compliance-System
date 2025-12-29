<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../bower_components/moment/moment.js"></script>
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>

    <script src="../asset/js/fontawesome.js"></script>

<script>
  $('#example1').DataTable({ responsive: true })
  $('#example2').DataTable({ responsive: true })
  $(document).on('click', '#admin_profile', function(e){
    e.preventDefault();
    $('#profile').modal('show');
    var user_id = $(this).data('user_id');
    var firstname = $(this).data('firstname');
    var lastname = $(this).data('lastname');
    var middlename = $(this).data('middlename');
    var address = $(this).data('address');
    var email = $(this).data('email');
    var contact = $(this).data('contact');
    var password = $(this).data('password');
    var questionnaire = $(this).data('questionnaire');
    var answer = $(this).data('answer');

    $('#user_id').val(user_id)
    $('#firstname').val(firstname)
    $('#lastname').val(lastname)
    $('#middlename').val(middlename)
    $('#address').val(address)
    $('#email').val(email)
    $('#contact').val(contact)
    $('#password').val(password)
    $('#questionnaire').val(questionnaire)
    $('#answer').val(answer)

  });

  
      $(function(){
        var url = window.location;
        $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');
        $('ul.treeview-menu a').filter(function() {
            return this.href == url;
        }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
      });
</script>