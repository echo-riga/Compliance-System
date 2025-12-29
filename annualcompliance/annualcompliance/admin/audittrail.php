<?php 
  session_start();
  include '../config/config.php';
  class data extends Connection{ 
    public function managedata(){ 
?>
<!DOCTYPE html>
<html>
<head><?php include 'head.php'; ?></head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include 'navbar.php'; ?>
    <?php include 'profile.php'; ?>
    <?php include 'sidebar.php'; ?>
    <div class="content-wrapper">
        <section class="content-header">
          <h1>Audit Trail</h1>
        </section>

        <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                    <div class="box-body table-responsive">
                        <?php
                        $xmlFile = '../controller/audit_logs.xml';

                        if (file_exists($xmlFile)) {
                            $xml = simplexml_load_file($xmlFile);
                        } else {
                            die("Error: audit log file not found.");
                        }
                        ?>
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <th>List</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>Date & Time</th>
                            </thead>
                            <tbody>
                              <?php
                                $id = 1;
                                foreach ($xml->log as $log) { ?>
                                    <tr>
                                        <td><?= $id++; ?></td>
                                        <td><?= $log->user; ?></td>
                                        <td><?= $log->action; ?></td>
                                        <td><?= $log->details; ?></td>
                                        <td><?= date('Y-m-d h:i:a', strtotime($log->timestamp)); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
            </div>
          </div>
        </div>
      </section>
      </div>
    </div>
  <?php include 'footer.php'; ?>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>