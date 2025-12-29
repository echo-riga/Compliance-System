<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add Event</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/eventsController.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Group <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <select class="form-control" id="" name="groups_id" required>
                        <option value="">Select</option>
                        <?php
                          $sql = "SELECT * FROM groups";
                          $stmt = $this->conn()->query($sql);
                          while($row = $stmt->fetch()){ ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                          <?php } ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <input class="form-control" id="" name="name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Description <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <input class="form-control" id="" name="description" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Location <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <input class="form-control" id="" name="location" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Date <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" id="" name="date" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Time In <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <select class="form-control time" id="" name="timein" required>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Time Out <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <select class="form-control time" id="" name="timeout" required>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Google Form Link <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <input class="form-control" id="" name="link" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Event</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/eventsController.php" enctype="multipart/form-data">
                <input type="hidden" name="id" id="edit_id">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Group <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <select class="form-control" id="edit_groups_id" name="groups_id" required>
                        <option value="">Select</option>
                        <?php
                          $sql = "SELECT * FROM groups";
                          $stmt = $this->conn()->query($sql);
                          while($row = $stmt->fetch()){ ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                          <?php } ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <input class="form-control" id="edit_name" name="name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Description <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <input class="form-control" id="edit_description" name="description" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Location <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <input class="form-control" id="edit_location" name="location" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Date <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" id="edit_date" name="date" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Time In <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <select class="form-control time" id="edit_timein" name="timein" required>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Time Out <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <select class="form-control time" id="edit_timeout" name="timeout" required>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Google Form Link <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <input class="form-control" id="edit_link" name="link" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Status <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                      <select class="form-control" id="" name="link_status">
                        <option value="">Select</option>
                        <option value="Completed">Completed</option>
                      </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
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
              <form class="form-horizontal" method="POST" action="../controller/eventsController.php">
                <input type="hidden" name="id" id="delete_id">
                <div class="text-center">
                    <p>DELETE EVENT</p>
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