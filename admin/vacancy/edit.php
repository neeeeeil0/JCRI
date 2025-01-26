<?php
    if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     }


  $jobid = $_GET['id'];
  $job = New Jobs();
  $res = $job->single_job($jobid);

  $publisherid = $res->PUBLISHERID;
  $sql = "SELECT * FROM tblusers where USERID = $publisherid";
  $mydb->setQuery($sql);
  $cur = $mydb->loadSingleResult();

  

?> 
<form class="form-horizontal span6" action="controller.php?action=edit" method="POST">

  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Update Job Vacancy</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for=
      "PUBLISHER">Publisher:</label>

      <div class="col-md-8">
        <input type="hidden" name="PUBLISHERID" value="<?php echo $res->PUBLISHERID;?>">
        <span class="form-control input-sm"><?php echo $cur->FULLNAME;?></span>
      </div>
    </div>
  </div> 

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for=
      "COMPANYNAME">Company Name:</label>

      <div class="col-md-8">
        <input type="hidden" name="JOBID" value="<?php echo $res->JOBID;?>">
        <select class="form-control input-sm" id="COMPANYID" name="COMPANYID">
          <option value="None">Select</option>
          <?php 
            $sql ="Select * From tblcompany WHERE COMPANYID=".$res->COMPANYID;
            $mydb->setQuery($sql);
            $result  = $mydb->loadResultList();
            foreach ($result as $row) {
              # code...
              echo '<option SELECTED value='.$row->COMPANYID.'>'.$row->COMPANYNAME.'</option>';
            }
            $sql ="Select * From tblcompany WHERE COMPANYID!=$res->COMPANYID ORDER BY COMPANYNAME";
            $mydb->setQuery($sql);
            $result  = $mydb->loadResultList();
            foreach ($result as $row) {
              # code...
              echo '<option value='.$row->COMPANYID.'>'.$row->COMPANYNAME.'</option>';
            }

          ?>
        </select>
      </div>
    </div>
  </div> 

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for=
      "CATEGORY">Classification:</label>

      <div class="col-md-8"> 
        <select class="form-control input-sm" id="CATEGORY" name="CATEGORY">
          <option value="None">Select</option>
          <?php 
            $sql ="SELECT * FROM `tblcategory` WHERE CATEGORY='".$res->CATEGORY."'";
            $mydb->setQuery($sql);
            $cur  = $mydb->loadResultList();
            foreach ($cur as $result) {
              # code...
              echo '<option SELECTED value='.$result->CATEGORYID.'>'.$result->CATEGORY.'</option>';
            }
            $sql ="SELECT * FROM `tblcategory` WHERE CATEGORY!='".$res->CATEGORY."' ORDER BY CATEGORY";
            $mydb->setQuery($sql);
            $cur  = $mydb->loadResultList();
            foreach ($cur as $result) {
              # code...
              echo '<option value='.$result->CATEGORYID.'>'.$result->CATEGORY.'</option>';
            }

          ?>
        </select>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for=
      "OCCUPATIONTITLE">Job Title:</label> 
      <div class="col-md-8">
          <input class="form-control input-sm" id="OCCUPATIONTITLE" name="OCCUPATIONTITLE" placeholder="Job Title"   autocomplete="none" value="<?php echo $res->OCCUPATIONTITLE; ?>"/> 
      </div>
    </div>
  </div>    

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for=
      "SALARIES">Salary:</label> 
      <div class="col-md-8">
          <input class="form-control input-sm" id="SALARIES" name="SALARIES" placeholder="Salary"   autocomplete="none" value="<?php echo $res->SALARIES ?>"/> 
      </div>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for=
      "JOBTYPE">Job Type:</label> 
      <div class="col-md-8">
        <select class="form-control input-sm" id="JOBTYPE" name="JOBTYPE">
          <option value="">Select</option>
          <option value="On-Site">On-Site</option>
          <option value="Work From Home">Work From Home</option>
          <option value="Hybrid">Hybrid</option>
        </select>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for=
      "JOBDESCRIPTION">Job Description:</label> 
      <div class="col-md-8">
        <textarea class="form-control input-sm" id="JOBDESCRIPTION" name="JOBDESCRIPTION" placeholder="Job Description"   autocomplete="none"><?php echo $res->JOBDESCRIPTION ?></textarea> 
      </div>
    </div>
  </div> 

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for=
      "QUALIFICATION_WORKEXPERIENCE">Qualification/Work Experience:</label> 
      <div class="col-md-8">
        <textarea class="form-control input-sm" id="QUALIFICATION_WORKEXPERIENCE" name="QUALIFICATION_WORKEXPERIENCE" placeholder="Qualification/Work Experience"   autocomplete="none" ><?php echo $res->QUALIFICATION_WORKEXPERIENCE ?></textarea> 
      </div>
    </div>
  </div> 
 

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for=
      "PREFEREDSEX">Prefered Sex:</label> 
      <div class="col-md-8">
          <select class="form-control input-sm" id="PREFEREDSEX" name="PREFEREDSEX">
          <option value="None">Select</option>
            <option <?php echo ($res->PREFEREDSEX=='Male') ? "SELECTED" :"" ?>>Male</option>
            <option <?php echo ($res->PREFEREDSEX=='Female') ? "SELECTED" :"" ?>>Female</option>
            <option <?php echo ($res->PREFEREDSEX=='Male/Female') ? "SELECTED" :"" ?>>Male/Female</option>
        </select>
      </div>
    </div>
  </div>
        
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for=
      "JOBSTATUS">Status:</label> 
      <div class="col-md-8">
          <select class="form-control input-sm" id="JOBSTATUS" name="JOBSTATUS">
          <option value="Closed">Select</option>
            <option <?php echo ($res->JOBSTATUS=='Open') ? "SELECTED" :"" ?>>Open</option>
            <option <?php echo ($res->JOBSTATUS=='Closed') ? "SELECTED" :"" ?>>Closed</option>
        </select>
      </div>
    </div>
  </div>   

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for=
      "idno"></label>  

      <div class="col-md-8">
          <button class="btn btn-primary btn-sm" name="save" type="submit" ><span class="fa fa-save fw-fa"></span> Save</button>
      <!-- <a href="index.php" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<strong>Back</strong></a> -->
      
      </div>
    </div>
  </div> 



</form>
       