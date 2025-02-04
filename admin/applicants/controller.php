<?php
require_once ("../../include/initialize.php");
 if(!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

if (isset($_GET['action']) && $_GET['action'] == 'fetchApplicants') {
    // Your query to fetch the data
    $mydb->setQuery("SELECT * FROM `tblcompany` c, `tbljobregistration` j, `tbljob` j2, `tblapplicants` a 
						WHERE c.`COMPANYID`=j.`COMPANYID` AND j.`JOBID`=j2.`JOBID` AND j.`APPLICANTID`=a.`APPLICANTID`");
    $cur = $mydb->loadResultList();

    // Output the table rows
    foreach ($cur as $result) {
        $rowClass = ($result->PENDINGAPPLICATION == 1) ? 'style="font-weight: bold;"' : '';

        echo '<tr ' . $rowClass . '>';
        echo '<td>' . $result->REGISTRATIONID . '</td>';
        echo '<td>' . $result->APPLICANT . '</td>';
        echo '<td>' . $result->OCCUPATIONTITLE . '</td>';
        echo '<td>' . $result->COMPANYNAME . '</td>';
        echo '<td>' . $result->REGISTRATIONDATE . '</td>';
        echo '<td>' . $result->REMARKS . '</td>';
        echo '<td align="center">
                <a title="View" href="index.php?view=view&id=' . $result->REGISTRATIONID . '" class="btn btn-info btn-xs">
                <span class="fa fa-info fw-fa"></span> View</a>
                <a title="Remove" href="controller.php?action=delete&id=' . $result->REGISTRATIONID . '" class="btn btn-danger btn-xs">
                <span class="fa fa-trash-o fw-fa"></span> Remove</a>
                </td>';
        echo '</tr>';
    }
    exit();  // Make sure to stop further execution
}


switch ($action) {
	case 'edit' :
	doEdit();
	break; 
	
	case 'delete' :
	doDelete();
	break;

	case 'photos' :
	doupdateimage();
	break;
   
   
    case 'addfiles' :
	doAddFiles();
	break;

	case 'approve' :
	doApproved();
	break;
	

	}
	function doEdit(){
	if(isset($_POST['save'])){

		if ( $_POST['FNAME'] == "" OR $_POST['LNAME'] == ""
			OR $_POST['MNAME'] == "" OR $_POST['ADDRESS'] == "" 
			OR $_POST['TELNO'] == "") {
			$messageStats = false;
			message("All fields are required!","error");
			redirect('index.php?view=add');
		}else{	

			$birthdate =  $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];

			$age = date_diff(date_create($birthdate),date_create('today'))->y;
		 	if ($age < 20 ){
		       message("Invalid age. 20 years old and above is allowed.", "error");
		       redirect("index.php?view=edit&id=".$_POST['EMPLOYEEID']);

		    }else{

		    	@$datehired = date_format(date_create($_POST['DATEHIRED']),'Y-m-d');

					$emp = New Employee(); 
					$emp->EMPLOYEEID 		= $_POST['EMPLOYEEID'];
					$emp->FNAME				= $_POST['FNAME']; 
					$emp->LNAME				= $_POST['LNAME'];
					$emp->MNAME 	   		= $_POST['MNAME'];
					$emp->ADDRESS			= $_POST['ADDRESS'];  
					$emp->BIRTHDATE	 		= $birthdate;
					$emp->BIRTHPLACE		= $_POST['BIRTHPLACE'];  
					$emp->AGE			    = $age;
					$emp->SEX 				= $_POST['optionsRadios']; 
					$emp->TELNO				= $_POST['TELNO'];
					$emp->CIVILSTATUS		= $_POST['CIVILSTATUS']; 
					$emp->POSITION			= trim($_POST['POSITION']);
					// $emp->DEPARTMENTID		= $_POST['DEPARTMENTID'];
					// $emp->DIVISIONID		= $_POST['DIVISIONID'];
					$emp->EMP_EMAILADDRESS		= $_POST['EMP_EMAILADDRESS'];
					$emp->EMPUSERNAME		= $_POST['EMPLOYEEID'];
					$emp->EMPPASSWORD		= sha1($_POST['EMPLOYEEID']);
					$emp->DATEHIRED			=  @$datehired;
					$emp->COMPANYID			= $_POST['COMPANYID'];

					$emp->update($_POST['EMPLOYEEID']);
 

				message("Employee has been updated!", "success");
				// redirect("index.php?view=view&id=".$_POST['EMPLOYEEID']);
		       redirect("index.php?view=edit&id=".$_POST['EMPLOYEEID']);
	    	}


		}
  	
	 
	}

} 
	function doDelete(){
		
		// if (isset($_POST['selector'])==''){
		// message("Select the records first before you delete!","error");
		// redirect('index.php');
		// }else{

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$subj = New Student();
		// 	$subj->delete($id[$i]);
		// }
			
		// }
		$id = 	$_GET['id'];
		$jobreg = New JobRegistration();
		$jobreg->delete($id);
		message("Applicant(s) already Deleted!","success");
		redirect('index.php');
		
		
	}

 
 
  function UploadImage(){
			$target_dir = "../../employee/photos/";
			$target_file = $target_dir . date("dmYhis") . basename($_FILES["picture"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			
			if($imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg"
		|| $imageFileType != "gif" ) {
				 if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
					return  date("dmYhis") . basename($_FILES["picture"]["name"]);
				}else{
					echo "Error Uploading File";
					exit;
				}
			}else{
					echo "File Not Supported";
					exit;
				}
} 

	function doupdateimage(){
 
			$errofile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile =$_FILES['photo']['name'];
		 	$location="photo/".$myfile;


		if ( $errofile > 0) {
				message("No Image Selected!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
		}else{
	 
				@$file=$_FILES['photo']['tmp_name'];
				@$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));
				@$image_name= addslashes($_FILES['photo']['name']); 
				@$image_size= getimagesize($_FILES['photo']['tmp_name']);

			if ($image_size==FALSE ) {
				message("Uploaded file is not an image!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
			}else{
					//uploading the file
					move_uploaded_file($temp,"photo/" . $myfile);
		 	
					 

						//$stud = New Student();
						//$stud->StudPhoto	= $location;
						//$stud->studupdate($_POST['StudentID']);
						//redirect("index.php?view=view&id=". $_POST['StudentID']);
					}
			}
			 
		}
function doApproved(){
global $mydb;
	if (isset($_POST['submit'])) {
		$id = $_POST['JOBREGID'];
		$applicantid = $_POST['APPLICANTID'];
		$modifiedby = $_SESSION['ADMIN_USERID'];
		$status = $_POST['STATUS'];
		$remarks = $_POST['REMARKS'];

		//For checking remarks or feedback
		$sql = "SELECT * 
				FROM tbljobregistration jr
				JOIN tbljob j ON jr.JOBID = j.JOBID
				WHERE jr.REGISTRATIONID = $id";
		$mydb->setQuery($sql);
		$res = $mydb->loadSingleResult();
		$oldremarks = $res->REMARKS;

		// For Checking if already exist in accepted applicants
		$accepted = new AcceptedApplicants();
		// Check if Registration ID already exists in Accepted Applicants
		$check1 = "SELECT * FROM tblacceptedapplicants WHERE REGISTRATIONID = $id";
		$mydb->setQuery($check1);
		$checkjobregid = $mydb->loadSingleResult();
		// Check if Applicant ID already exists in Accepted Applicants
		$check2 = "SELECT * FROM tblacceptedapplicants WHERE APPLICANTID = $applicantid";
		$mydb->setQuery($check2);
		$checkapplicantid = $mydb->loadSingleResult();

		if ($status != "Accepted"){
			if (!$checkjobregid && !$checkapplicantid) {
				$sql="UPDATE `tbljobregistration` 
						SET `STATUS`='{$status}',`REMARKS`='{$remarks}',`MODIFIEDBY`='{$modifiedby}',PENDINGAPPLICATION=0,HVIEW=0,DATETIMEUPDATED=NOW() 
						WHERE `REGISTRATIONID`='{$id}'";
				$mydb->setQuery($sql);
				$cur = $mydb->executeQuery();
			} else {
				message("Cannot update: STATUS cannot be changed. $applicantid is already hired", "error");
				redirect("index.php?view=view&id=".$id);
			}
		} else if ($status == "Accepted"){
			if (!$checkjobregid && !$checkapplicantid) {
				//Sets all the other applied job to REJECTED, pendingapplication to 0
				$sql="UPDATE `tbljobregistration` 
						SET STATUS='Rejected',PENDINGAPPLICATION=0,HVIEW=0,DATETIMEUPDATED=NOW()
						WHERE `APPLICANTID`='{$applicantid}'";
				$mydb->setQuery($sql);
				$cur = $mydb->executeQuery();

				$accepted->REGISTRATIONID 		= $res->REGISTRATIONID;
				$accepted->APPLICANTID	 		= $res->APPLICANTID;
				$accepted->DEPLOYEDCOMPANYID 	= $res->COMPANYID;
				$accepted->JOBTITLE 			= $res->OCCUPATIONTITLE;
				$accepted->HIREDDATE 			= date('Y-m-d H:i:s');
				$accepted->create();

				// Update Status and Remarks
				$sql="UPDATE `tbljobregistration` SET `STATUS`='{$status}',`REMARKS`='{$remarks}',`MODIFIEDBY`='{$modifiedby}',PENDINGAPPLICATION=0,HVIEW=0,DATETIMEUPDATED=NOW() WHERE `REGISTRATIONID`='{$id}'";
				$mydb->setQuery($sql);
				$cur = $mydb->executeQuery();
			} else {		
				// Update only the Remarks field
				$sql = "UPDATE `tbljobregistration` 
						SET `REMARKS`='{$remarks}', `MODIFIEDBY`='{$modifiedby}', DATETIMEUPDATED=NOW() 
						WHERE `REGISTRATIONID`='{$id}'";
				$mydb->setQuery($sql);
				$cur = $mydb->executeQuery();
			}
		}

		// For New Feedback
		if ($cur) {
			if(strcmp($oldremarks, $remarks) != 0) {
				$sql="INSERT INTO `tblfeedback` (`APPLICANTID`, `REGISTRATIONID`, `FEEDBACK`, `SENDERID`, `VIEW`) VALUES ('{$applicantid}','{$id}','{$remarks}', '{$modifiedby}','1')";
				$mydb->setQuery($sql);
				$cur = $mydb->executeQuery();

				message("Applicant ID: $applicantid has been updated.", "success");
			}
		}
		redirect("index.php"); 
	}
}
 
?>