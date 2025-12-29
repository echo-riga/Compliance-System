<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add User</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/usersController.php">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                        <label for="employeeid" class="col-sm-12">Employee ID</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="" name="employeeid" required>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="firstname" class="col-sm-12">Firstname</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="" name="firstname" required>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="lastname" class="col-sm-12">Lastname</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="" name="lastname" required>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="middlename" class="col-sm-12">Middlename</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="" name="middlename" required>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                        <label for="birthdate" class="col-sm-12">Birthdate</label>
                        <div class="col-sm-12">
                          <input type="date" class="form-control" id="" name="birthdate" required>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                        <label for="email" class="col-sm-12">Email</label>
                        <div class="col-sm-12">
                          <input type="email" class="form-control" id="" name="email" required>
                        </div>
                    </div>
                  </div>
                  <!-- <div class="col-lg-6">
                    <div class="form-group">
                      <label for="middlename" class="col-sm-12">Password</label>
                      <div class="col-sm-12">
                        <div class="form-control pl-2 pr-2 p-0" style="place-items:center;display: flex;">
                          <input id="password-field" type="password" name="password" placeholder="********" style="outline: none;width: 100%;height: 100%;border: unset;background: transparent;" required>
                          <i toggle="#password-field" class="fas fa-eye text-muted toggle-password"></i>
                        </div>
                        <small id="password-strength-msg" class="text-muted">Required: min 8 chars, uppercase, number, symbol</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="middlename" class="col-sm-12">Confirm Password</label>
                      <div class="col-sm-12">
                        <div class="form-control pl-2 pr-2 p-0" style="place-items:center;display: flex;">
                          <input id="password-field2" type="password" name="confirmpassword" placeholder="********" style="outline: none;width: 100%;height: 100%;border: unset;background: transparent;" required>
                          <i toggle="#password-field2" class="fas fa-eye text-muted toggle-password2"></i>
                        </div>
                        <small id="password-strength-msg2" class="text-muted">Required: min 8 chars, uppercase, number, symbol</small>
                      </div>
                    </div>
                  </div> -->
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="middlename" class="col-sm-12">Status Of Employment</label>
                      <div class="col-sm-12">
                        <div class="form-control pl-2 pr-2 p-0" style="place-items:center;display: flex;">
                          <select id="" name="status_of_employment" style="outline: none;width: 100%;height: 100%;border: unset;background: transparent;" required>
                            <option value="Job order">Job order</option>
                            <option value="Casual">Casual</option>
                            <option value="Permanent">Permanent</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat registerbtn" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>


<!-- Change Status -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Change Status</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/usersController.php" enctype="multipart/form-data">
                <input type="hidden" name="id" id="edit_id">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Status</label>
                    <div class="col-sm-12">
                      <select class="form-control" name="status" required>
                          <option value="1">Approved</option>
                      </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="changestatus"><i class="fa fa-check-square-o"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/usersController.php">
                <input type="hidden" name="id" id="delete_id">
                <div class="text-center">
                    <p>DELETE COMPLIANCE</p>
                    <h2 class="bold catname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>


