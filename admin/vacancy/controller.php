<?php

require_once ("../../include/initialize.php");
use JCRI\services\SendNotification;




if (!isset($_SESSION['ADMIN_USERID'])){
	redirect(web_root."admin/index.php");
}


$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break;
	
	case 'delete' :
	doDelete();
	break;
	}
   
	function doInsert(){
		global $mydb;
		if(isset($_POST['save'])){ 
			if ( $_POST['COMPANYID'] == "None") {
				$messageStats = false;
				message("All field is required!","error");
				redirect('index.php?view=add');
			}else{	
				$sql = "SELECT * FROM tblcategory where CATEGORYID = {$_POST['CATEGORY']}";
				$mydb->setQuery($sql);
				$cat = $mydb->loadSingleResult();
				$_POST['CATEGORY']=$cat->CATEGORY;
				$publisher = $_SESSION['ADMIN_USERID'];
				$job = New Jobs();
				$job->COMPANYID							= $_POST['COMPANYID']; 
				$job->CATEGORY							= $_POST['CATEGORY']; 
				$job->OCCUPATIONTITLE					= $_POST['OCCUPATIONTITLE'];
				//$job->REQ_NO_EMPLOYEES					= $_POST['REQ_NO_EMPLOYEES'];
				$job->SALARIES							= $_POST['SALARIES'];
				$job->JOBSETTING						= $_POST['JOBSETTING'];
				$job->QUALIFICATION_WORKEXPERIENCE		= $_POST['QUALIFICATION_WORKEXPERIENCE'];
				$job->JOBDESCRIPTION					= $_POST['JOBDESCRIPTION'];
				$job->PREFEREDSEX						= $_POST['PREFEREDSEX'];
				$job->DATEPOSTED						= date('Y-m-d H:i:s');
				$job->PUBLISHERID 						= $publisher;
				$job->JOBSTATUS							= $_POST['JOBSTATUS'];
				$job->create();

				$jobID = $mydb->insert_id();

				$sql = "SELECT j.*, c.COMPANYNAME, c.COMPANYADDRESS 
						FROM tbljob AS j 
						INNER JOIN tblcompany AS c ON j.COMPANYID = c.COMPANYID 
						WHERE j.JOBID = $jobID";
				$mydb->setQuery($sql);
				$jobInfo = $mydb->loadSingleResult();

				$jobData = [
					'id' => $jobID,
					'title' => $job->OCCUPATIONTITLE,
					'company' => $jobInfo->COMPANYNAME,
					'location' => $jobInfo->COMPANYADDRESS,
					'datePosted' => date('M d, Y', strtotime($job->DATEPOSTED)),
					'setting' => $job->JOBSETTING,
					'salary' => $job->SALARIES,
					'sex' => $job->PREFEREDSEX,
					'experience' => $job->QUALIFICATION_WORKEXPERIENCE,
					'description' => $job->JOBDESCRIPTION
				];

				$notification = new SendNotification();
				$sexFilter = "";
				if ($job->PREFEREDSEX == 'Male') {
					$sexFilter = "WHERE SEX = 'Male'";
				} elseif ($job->PREFEREDSEX == 'Female') {
					$sexFilter = "WHERE SEX = 'Female'";
				}

				$sql = "SELECT * FROM tblapplicants $sexFilter";
				$mydb->setQuery($sql);
				$applicants = $mydb->loadResultList() ?? [];

				// Send email notifications to each applicant
				if ($applicants.length > 0){
					foreach ($applicants as $applicant) {
						// Check if the applicant has an email
						if (!empty($applicant->EMAILADDRESS)) {
							$notification->sendTemplatedEmail($applicant->EMAILADDRESS, $jobData);
						}
					}
				}
			
				message("New Job Vacancy created successfully!", "success");
				redirect("index.php");
				
			}
		}
	}

	function doEdit(){
		global $mydb;
		if(isset($_POST['save'])){
			if ( $_POST['COMPANYID'] == "None") {
				$messageStats = false;
				message("All field is required!","error");
				redirect('index.php?view=add');
			}else{	
				$sql = "SELECT * FROM tblcategory where CATEGORYID = {$_POST['CATEGORY']}";
				$mydb->setQuery($sql);
				$cat = $mydb->loadSingleResult();
				$_POST['CATEGORY']=$cat->CATEGORY;
				$jobID = $_POST['JOBID'];
				$job = New Jobs();
				$job->COMPANYID							= $_POST['COMPANYID']; 
				$job->CATEGORY							= $_POST['CATEGORY']; 
				$job->OCCUPATIONTITLE					= $_POST['OCCUPATIONTITLE'];
				$job->REQ_NO_EMPLOYEES					= $_POST['REQ_NO_EMPLOYEES'];
				$job->SALARIES							= $_POST['SALARIES'];
				$job->JOBSETTING						= $_POST['JOBSETTING'];
				//$job->DURATION_EMPLOYEMENT			= $_POST['DURATION_EMPLOYEMENT'];
				$job->QUALIFICATION_WORKEXPERIENCE		= $_POST['QUALIFICATION_WORKEXPERIENCE'];
				$job->JOBDESCRIPTION					= $_POST['JOBDESCRIPTION'];
				$job->PREFEREDSEX						= $_POST['PREFEREDSEX'];
				//$job->SECTOR_VACANCY					= $_POST['SECTOR_VACANCY'];
				$job->JOBSTATUS							= $_POST['JOBSTATUS'];
				$job->DATEUPDATED						= date('Y-m-d H:i:s');
				$job->update($_POST['JOBID']);


				if ($_POST['JOBSTATUS'] == 'Open' ) {
					$sql = "INSERT INTO tblnotification (APPLICANTID, JOBID, ISVIEWED, DATECREATED)
							SELECT APPLICANTID, $jobID, 0, NOW()
							FROM tblapplicants";
					$mydb->setQuery($sql);
					$mydb->executeQuery();
				}
				
				message("Job Vacancy has been updated!", "success");
				redirect("index.php");
			}
		}

	}


	function doDelete(){
		// if (isset($_POST['selector'])==''){
		// message("Select a records first before you delete!","error");
		// redirect('index.php');
		// }else{

			$id = $_GET['id'];

			$job = New Jobs();
			$job->delete($id);

			message("Company has been Deleted!","info");
			redirect('index.php');

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$category = New Category();
		// 	$category->delete($id[$i]);

		// 	message("Category already Deleted!","info");
		// 	redirect('index.php');
		// }
		// }
		
	}
?>