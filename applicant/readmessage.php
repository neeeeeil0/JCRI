<?php 
  $id = isset($_GET['id']) ? $_GET['id'] :0;

$sql = "SELECT * FROM `tblcompany` c, `tbljobregistration` jr, `tblfeedback` f, `tbljob` j, `tblusers` u
          WHERE c.`COMPANYID` = j.`COMPANYID` 
          AND jr.`REGISTRATIONID` = f.`REGISTRATIONID`
          AND jr.`JOBID`=j.`JOBID`
          AND f.`SENDERID` = u.`USERID`
          AND f.`FEEDBACKID` = '{$id}'";
$mydb->setQuery($sql);
$res = $mydb->loadSingleResult();

$sql="UPDATE `tblfeedback` SET VIEW=0 WHERE `FEEDBACKID`='{$res->FEEDBACKID}'";
$mydb->setQuery($sql);
$mydb->executeQuery();

$applicant = new Applicants();
$appl  = $applicant->single_applicant($_SESSION['APPLICANTID']);


?> 

<div class="content-wrapper"> 
  <section class="content">
    <div class="row"> 
      <div class="col-md-12">

          <div class="box-header with-border">
            <h3 class="box-title">Read Message</h3> 
          </div>

          <div class="sub-header">
            <h3><?php  echo $res->OCCUPATIONTITLE; ?></h3>
            <h5>Company: <?php  echo $res->COMPANYNAME; ?></h5>
            <h5>Sender: <?php  echo $res->FULLNAME; ?>
              <span class="mailbox-read-time pull-right">
                <?php  echo date_format(date_create($res->DATETIMEAPPROVED),'d M. Y h:i a'); ?>
              </span>
            </h5>
          </div>

          <div class="message">
            <p>Hello <?php  echo $appl->FNAME; ?>,</p>  
            <p><?php  echo $res->REMARKS; ?></p>
            <p>Thanks,<br><?php  echo $res->FULLNAME; ?></p>
          </div>
  
      </div> 
    </div>
  </section> 
</div>
  