<?php 
  $id = isset($_GET['id']) ? $_GET['id'] :0;

$sql = "SELECT * FROM `tblcompany` c, `tbljobregistration` jr, `tblfeedback` f, `tbljob` j 
          WHERE c.`COMPANYID` = j.`COMPANYID` 
          AND jr.`REGISTRATIONID` = f.`REGISTRATIONID`
          AND jr.`JOBID`=j.`JOBID`
          AND f.`FEEDBACKID` = '{$id}'";
$mydb->setQuery($sql);
$res = $mydb->loadSingleResult();

$sql="UPDATE `tblfeedback` SET VIEW=0 WHERE `FEEDBACKID`='{$res->FEEDBACKID}'";
$mydb->setQuery($sql);
$mydb->executeQuery();

$applicant = new Applicants();
$appl  = $applicant->single_applicant($_SESSION['APPLICANTID']);


?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Main content -->
    <section class="content">
      <div class="row"> 
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Read Message</h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3><?php  echo $res->OCCUPATIONTITLE; ?></h3>
                <h5>From: <?php  echo $res->COMPANYNAME; ?>
                  <span class="mailbox-read-time pull-right"><?php  echo date_format(date_create($res->DATETIMEAPPROVED),'d M. Y h:i a'); ?></span></h5>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  <!-- <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete"> -->
                    <!-- <i class="fa fa-trash-o"></i></button> -->
               <!--    <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                    <i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                    <i class="fa fa-share"></i></button> -->
                </div>
                <!-- /.btn-group -->
                <!-- <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print"> -->
                  <!-- <i class="fa fa-print"></i></button> -->
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p>Hello <?php  echo $appl->FNAME; ?>,</p>  
                  <p><?php  echo $res->REMARKS; ?></p>


                <p>Thanks,<br><?php  echo $res->COMPANYNAME; ?></p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <!-- <div class="box-footer">
              <ul class="mailbox-attachments clearfix">
                <li>
                  <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Sep2014-report.pdf</a>
                        <span class="mailbox-attachment-size">
                          1,245 KB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                  </div>
                </li>
                <li>
                  <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> App Description.docx</a>
                        <span class="mailbox-attachment-size">
                          1,245 KB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                  </div>
                </li>
                <li>
                  <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo1.png" alt="Attachment"></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo1.png</a>
                        <span class="mailbox-attachment-size">
                          2.67 MB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                  </div>
                </li>
                <li>
                  <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo2.png" alt="Attachment"></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo2.png</a>
                        <span class="mailbox-attachment-size">
                          1.9 MB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                  </div>
                </li>
              </ul>
            </div> -->
            <!-- /.box-footer -->
            <div class="box-footer">
         <!--      <div class="pull-right">
                <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
                <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
              </div> -->
              <!-- <button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
              <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button> -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  