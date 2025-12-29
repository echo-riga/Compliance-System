<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Change Status</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/groupsmembersController.php" enctype="multipart/form-data">
                <input type="hidden" name="id" id="edit_id">
                <input type="hidden" name="code" value="<?php echo $_GET['code'] ?>">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Status*</span></label>
                    <div class="col-sm-12">
                      <select class="form-control" id="edit_status" name="status" required>
                        <option value="">Select</option>
                        <option value="Warning">Warning</option>
                        <option value="Remove">Remove</option>
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


<!-- Edit -->
<div class="modal fade" id="joinstatus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Change Status</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/groupsmembersController.php" enctype="multipart/form-data">
                <input type="hidden" name="id" id="edit_joinstatus_id">
                <input type="hidden" name="code" value="<?php echo $_GET['code'] ?>">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Status*</span></label>
                    <div class="col-sm-12">
                      <select class="form-control" name="join_status" required>
                        <option value="">Select</option>
                        <option value="Approved">Approved</option>
                        <option value="Reject">Reject</option>
                      </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="joinstatus"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>
