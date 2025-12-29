<div class="modal fade" id="profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><?php if ($_SESSION['type'] == 0) {
                  echo "Admin";
                } else { echo ""; } ?> Profile</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/profileController.php" enctype="multipart/form-data">
                <div class="form-group" style="display:<?php if ($_SESSION['type'] != 0) {
                  echo "none";
                } else { echo "block"; } ?>">
                </div>
                <div class="form-group">
                  <input type="hidden" name="user_id" id="user_id">
                    <label for="email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-3 control-label">Contact</label>
                    <div class="col-sm-9">
                      <input class="form-control" id="contact" name="contact" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9"> 
                      <input type="password" class="form-control" id="password" name="password" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="firstname" name="firstname" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="lastname" name="lastname" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Middlename</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="middlename" name="middlename" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="address" name="address" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Questionnaire</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="questionnaire" name="questionnaire">
                        <option value="">-- Select a Security Question --</option>
                        <option value="What is your full name?">What is your full name?</option>
                        <option value="What is your favorite color?">What is your favorite color?</option>
                        <option value="What is your favorite food?">What is your favorite food?</option>
                        <option value="What is your favorite number?">What is your favorite number?</option>
                        <option value="What is the name of your first pet?">What is the name of your first pet?</option>
                        <option value="What city were you born in?">What city were you born in?</option>
                        <option value="What is your favorite movie or TV show?">What is your favorite movie or TV show?</option>
                        <option value="What is your favorite book or author?">What is your favorite book or author?</option>
                        <option value="What is your mother’s maiden name?">What is your mother’s maiden name?</option>
                        <option value="What is the make and model of your first vehicle?">What is the make and model of your first vehicle?</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Answer</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="answer" name="answer">
                    </div>
                </div>
           
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo:</label>

                    <div class="col-sm-9">
                      <input type="file" id="img" name="img">
                    </div>
                </div>
                <hr>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="saveadmin"><i class="fa fa-check-square-o"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>