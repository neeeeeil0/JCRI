<?php
    if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     }

  $id = $_GET['id'];

  $sql = "
    SELECT * 
    FROM tblacceptedapplicants aa
    LEFT JOIN tbljobregistration jr ON jr.REGISTRATIONID = aa.REGISTRATIONID
    LEFT JOIN tbljob j ON j.JOBID = jr.JOBID
    LEFT JOIN tblapplicants a ON a.APPLICANTID = aa.APPLICANTID
    LEFT JOIN tblcompany c ON c.COMPANYID = aa.DEPLOYEDCOMPANYID
    WHERE aa.ACCEPTEDID = $id
  ";

  $mydb->setQuery($sql);
  $res = $mydb->loadSingleResult();
?> 

<form class="form-horizontal span6" action="controller.php?action=edit" method="POST">
  <input type="hidden" name="ACCEPTEDID" value="<?php echo $res->ACCEPTEDID ;?>" readonly>
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Update Hired Applicant</h1>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="EMPLOYEEID">Employee ID:</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="EMPLOYEEID" name="EMPLOYEEID" type="text" placeholder="Set Employee ID" value="<?php echo $res->EMPLOYEEID ?? "";?>">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="FULLNAME">Hired Name:</label>
      <div class="col-md-8">
        <input class="form-control input-sm" id="FULLNAME" name="FULLNAME" type="text" value="<?php echo $res->APPLICANT ;?>" readonly>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="JOBTITLE">Job Title:</label>
      <div class="col-md-8">
        <input class="form-control input-sm" id="JOBTITLE" name="JOBTITLE" type="text" value="<?php echo $res->OCCUPATIONTITLE ;?>" readonly>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYNAME">Company Name:</label>
      <div class="col-md-8">
        <input class="form-control input-sm" id="COMPANYNAME" name="COMPANYNAME" type="text" value="<?php echo $res->COMPANYNAME ;?>" readonly>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="HIREDDATE">Hired Date:</label>
      <div class="col-md-8">
        <input class="form-control input-sm" id="HIREDDATE" name="HIREDDATE" type="text" value="<?php echo date("M. j, Y, g:ia", strtotime($res->HIREDDATE)) ;?>" readonly>
      </div>
    </div>
  </div>

  <!--
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYADDRESS">Company Address:</label> 
      <div class="col-md-8">
        <textarea class="form-control input-sm" id="COMPANYADDRESS" name="COMPANYADDRESS" placeholder=
          "Company Address" type="text" value="" required readonly onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off"><?php echo $res->COMPANYADDRESS ;?></textarea>
      </div>
    </div>
  </div> -->

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for=
      "idno"></label>

      <div class="col-md-8">
        <!-- <a href="index.php" class="btn btn_fixnmix"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<strong>Back</strong></a> -->
        <button class="btn btn-primary btn-sm" name="save" type="submit" ><span class="fa fa-save fw-fa"></span> Save</button>
      </div>
    </div>
  </div>
</form>
