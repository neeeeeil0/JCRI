<?php 
global $mydb;
	$red_id = isset($_GET['id']) ? $_GET['id'] : '';

	$jobregistration = New JobRegistration();
	$jobreg = $jobregistration->single_jobregistration($red_id);
	 // `COMPANYID`, `JOBID`, `APPLICANTID`, `APPLICANT`, `REGISTRATIONDATE`, `REMARKS`, `FILEID`, `PENDINGAPPLICATION`

	$applicant = new Applicants();
	$appl = $applicant->single_applicant($jobreg->APPLICANTID);
 // `FNAME`, `LNAME`, `MNAME`, `ADDRESS`, `SEX`, `CIVILSTATUS`, `BIRTHDATE`, `BIRTHPLACE`, `AGE`, `USERNAME`, `PASS`, `EMAILADDRESS`,CONTACTNO

	$jobvacancy = New Jobs();
	$job = $jobvacancy->single_job($jobreg->JOBID);
 // `COMPANYID`, `CATEGORY`, `OCCUPATIONTITLE`, `REQ_NO_EMPLOYEES`, `SALARIES`, `DURATION_EMPLOYEMENT`, `QUALIFICATION_WORKEXPERIENCE`, `JOBDESCRIPTION`, `PREFEREDSEX`, `SECTOR_VACANCY`, `JOBSTATUS`, `DATEPOSTED`

	$company = new Company();
	$comp = $company->single_company($jobreg->COMPANYID);
	 // `COMPANYNAME`, `COMPANYADDRESS`, `COMPANYCONTACTNO`

	$sql = "SELECT * FROM `tblattachmentfile` WHERE `FILEID`=" .$jobreg->FILEID;
	$mydb->setQuery($sql);
	$attachmentfile = $mydb->loadSingleResult();


?> 
<style type="text/css">
.content-header {
	min-height: 50px;
	border-bottom: 1px solid #ddd;
	font-size: 15px;
	font-weight: bold;
}
.content-body {
	min-height: 350px;
	/*border-bottom: 1px solid #ddd;*/
}
.content-body >p {
	padding:10px;
	font-size: 12px;
	font-weight: bold;
	border-bottom: 1px solid #ddd;
}
.content-footer {
	min-height: 100px;
	border-top: 1px solid #ddd;

}
.content-footer > p {
	padding:5px;
	font-size: 15px;
	font-weight: bold; 
}
 
.content-footer textarea {
	width: 100%;
	height: 200px;
}
.content-footer  .submitbutton{  
	margin-top: 20px;
	/*padding: 0;*/

}
</style>
<form action="controller.php?action=approve" method="POST">
<div class="col-sm-12 content-header" style="">View Details</div>
<div class="col-sm-6 content-body" > 
	<p>Job Details</p> 
	<h3><?php echo $job->OCCUPATIONTITLE; ?></h3>
	<input type="hidden" name="JOBREGID" value="<?php echo $jobreg->REGISTRATIONID;?>">
	<input type="hidden" name="APPLICANTID" value="<?php echo $appl->APPLICANTID;?>">

	<div class="col-sm-6">
		<p>Job Details : </p>  
		<ul>
			<li><i class="fp-ht-tv"></i>Job Setting : <?php echo $job->JOBSETTING; ?></li>
            <li><i class="fp-ht-food"></i>Salary : ₱ <?php echo number_format($job->SALARIES,2);  ?></li>
            <li><i class="fp-ht-tv"></i>Prefered Sex : <?php echo $job->PREFEREDSEX; ?></li>
        </ul>
	</div> 
	<div class="col-sm-12">
		<p>Job Description : </p>   
		<p style="margin-left: 15px;"><?php echo $job->JOBDESCRIPTION;?></p>
	</div>
	<div class="col-sm-12"> 
		<p>Qualification/Work Experience : </p>
		<p style="margin-left: 15px;"><?php echo $job->QUALIFICATION_WORKEXPERIENCE; ?></p>
	</div>
	<div class="col-sm-12"> 
		<p>Employeer : </p>
		<p style="margin-left: 15px;"><?php echo $comp->COMPANYNAME ; ?></p> 
		<p style="margin-left: 15px;">@ <?php echo $comp->COMPANYADDRESS ; ?></p>
	</div>
</div>

<div class="col-sm-6 content-body" >
	<p>Applicant Infomation</p> 
	<h3> <?php echo $appl->LNAME. ', ' .$appl->FNAME . ' ' . $appl->MNAME;?></h3>
	<ul> 
		<li>Address : <?php echo $appl->ADDRESS; ?></li>
		<li>Contact No. : <?php echo $appl->CONTACTNO;?></li>
		<li>Email Address. : <?php echo $appl->EMAILADDRESS;?></li>
		<li>Sex: <?php echo $appl->SEX;?></li>
		<li>Age : <?php echo $appl->AGE;?></li> 
	</ul>
	<div class="col-sm-12"> 
		<p>Educational Attainment : </p>
		<p style="margin-left: 15px;"><?php echo $appl->DEGREE;?></p>
	</div>
</div>

<div class="col-sm-12 content-footer">
<p><i class="fa fa-paperclip"></i>  Attachment Files</p>
	<div class="col-sm-12 slider">
		 <h4>Download Resume: <a href="<?php echo web_root.'applicant/'.$attachmentfile->FILE_LOCATION; ?>"><?php echo $attachmentfile->FILE_NAME?></a></h4>
	</div> 
	</div>

	
<div class="col-sm-12 content-footer">
	<p>Applicant Status</p>
	<div class="form-group">
		<label class="col-md-1 control-label" for=
		"STATUS">Status:</label>
		<div class="col-md-3 ">
			<select class="form-control input-sm" id="STATUS" name="STATUS" required>
				<?php
					echo '<option SELECTED hidden>'.$jobreg->STATUS.'</option>';
				?>
				<option>Pending</option>
				<option>For Review</option>
				<option>For Initial Screening</option>
				<option>For Interview</option>
				<option>For Assessment</option>
				<option style="background-color:green;color:white;">Accepted</option>
				<option style="background-color:red;color:white;">Rejected</option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-12">
			<label for="FEEDBACK">Feedback:</label>
			<textarea class="input-group" name="REMARKS"><?php echo isset($jobreg->REMARKS) ? $jobreg->REMARKS : ""; ?></textarea>
		</div>
		<div class="col-sm-12  submitbutton "> 
			<button type="submit" name="submit" class="btn btn-primary">Send</button>
		</div>
	</div>
</div>
</form>