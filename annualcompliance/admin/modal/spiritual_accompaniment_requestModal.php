<!-- Edit -->
<div class="modal fade" id="changestatus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Change Status</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/spiritual_accompaniment_requestController.php" enctype="multipart/form-data">
                <input type="hidden" name="id" id="edit_spiritual_accompaniment_users_id">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Status*</span></label>
                    <div class="col-sm-12">
                      <select class="form-control" id="edit_status" name="status" required>
                        <option value="">Select</option>
                        <option value="Approved">Approved</option>
                        <option value="Declined">Declined</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Message*</span></label>
                    <div class="col-sm-12">
                      <textarea class="form-control" id="" name="description" rows="6" required></textarea>
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