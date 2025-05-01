<?php
if (!isset($_SESSION['ADMIN_USERID'])) {
    redirect(web_root . "admin/index.php");
}
?>
<form class="form-horizontal span6" action="controller.php?action=add" method="POST">

  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Add New Job Vacancy</h1>
    </div>
  </div>

  <!-- Company Selection -->
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYID">Select Company:</label>
      <div class="col-md-8">
        <select class="form-control input-sm" id="COMPANYID" name="COMPANYID" required>
          <option value="">Please select a company</option>
          <?php 
            $sql = "SELECT * FROM tblcompany ORDER BY COMPANYNAME";
            $mydb->setQuery($sql);
            $res = $mydb->loadResultList();
            foreach ($res as $row) {
              echo '<option value="' . $row->COMPANYID . '">' . $row->COMPANYNAME . '</option>';
            }
          ?>
        </select>
      </div>
    </div>
  </div>

  <!-- Job Classification -->
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="CATEGORY">Job Classification:</label>
      <div class="col-md-8">
        <select class="form-control input-sm" id="CATEGORY" name="CATEGORY" required>
          <option value="">Select classification</option>
          <?php 
            $sql = "SELECT * FROM tblcategory ORDER BY CATEGORY";
            $mydb->setQuery($sql);
            $res = $mydb->loadResultList();
            foreach ($res as $row) {
              echo '<option value="' . $row->CATEGORYID . '">' . $row->CATEGORY . '</option>';
            }
          ?>
        </select>
      </div>
    </div>
  </div>

  <!-- Job Title -->
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="OCCUPATIONTITLE">Job Title:</label>
      <div class="col-md-8">
        <input class="form-control input-sm" type="text" id="OCCUPATIONTITLE" name="OCCUPATIONTITLE" placeholder="Enter the job title, e.g., Software Engineer" required>
      </div>
    </div>
  </div>

  <!-- Salary -->
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="SALARIES">Salary Range:</label>
      <div class="col-md-8">
        <input class="form-control input-sm" type="number" id="SALARIES" name="SALARIES" placeholder="Enter the salary in USD" min="0" step="500">
      </div>
    </div>
  </div>

  <!-- Job Setting -->
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="JOBSETTING">Job Setting:</label>
      <div class="col-md-8">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="JOBSETTING" id="onSite" value="On-Site" required>
          <label class="form-check-label" for="onSite">On-Site</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="JOBSETTING" id="workFromHome" value="Work From Home">
          <label class="form-check-label" for="workFromHome">Work From Home</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="JOBSETTING" id="hybrid" value="Hybrid">
          <label class="form-check-label" for="hybrid">Hybrid</label>
        </div>
      </div>
    </div>
  </div>

  <!-- Job Description -->
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="JOBDESCRIPTION">Job Description:</label>
      <div class="col-md-8">
        <textarea class="form-control input-sm" id="JOBDESCRIPTION" name="JOBDESCRIPTION" rows="4" placeholder="Briefly describe the job responsibilities and requirements"></textarea>
      </div>
    </div>
  </div>

  <!-- Qualifications -->
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="QUALIFICATION_WORKEXPERIENCE">Qualifications/Work Experience:</label>
      <div class="col-md-8">
        <textarea class="form-control input-sm" id="QUALIFICATION_WORKEXPERIENCE" name="QUALIFICATION_WORKEXPERIENCE" rows="4" placeholder="Enter required qualifications, e.g., Bachelor's Degree, 3 years experience"></textarea>
      </div>
    </div>
  </div>

  <!-- Preferred Sex -->
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="PREFEREDSEX">Preferred Gender:</label>
      <div class="col-md-8">
        <select class="form-control input-sm" id="PREFEREDSEX" name="PREFEREDSEX">
          <option value="None">No preference</option>
          <option>Male</option>
          <option>Female</option>
          <option>Male/Female</option>
        </select>
      </div>
    </div>
  </div>

  <!-- Job Status -->
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="JOBSTATUS">Job Status:</label>
      <div class="col-md-8">
        <select class="form-control input-sm" id="JOBSTATUS" name="JOBSTATUS">
          <option value="Closed">Closed</option>
          <option>Open</option>
        </select>
      </div>
    </div>
  </div>

  <!-- Submit Button -->
  <div class="form-group">
    <div class="col-md-8 text-center">
      <button class="btn btn-primary btn-sm" name="save" type="submit">
        <i class="fa fa-save"></i> Save
      </button>
    </div>
  </div>

</form>
