<?php
require_once ("../../include/initialize.php");
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

	case 'photos' :
	doupdateimage();
	break;

 
	}
   
	function doInsert(){
		if(isset($_POST['save'])){


		if ($_POST['U_NAME'] == "" OR $_POST['U_USERNAME'] == "" OR $_POST['U_PASS'] == "") {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
			$user = New User();
			$user->USERID 			= $_POST['user_id'];
			$user->FULLNAME 		= $_POST['U_NAME'];
			$user->CONTACT			= $_POST['U_CONTACT'];
			$user->EMAIL			= $_POST['U_EMAIL'];
			$user->USERNAME			= $_POST['U_USERNAME'];
			$user->PASS				= sha1($_POST['U_PASS']);
			$user->ROLE				= $_POST['U_ROLE'];
			$user->DELETEABLE		= 1;
			$user->create();

						$autonum = New Autonumber(); 
						$autonum->auto_update('userid');

			message("The account [". $_POST['U_NAME'] ."] created successfully!", "success");
			redirect("index.php");
			
		}
		}

	}

	function doEdit(){
		if(isset($_POST['save'])){

			$user = New User(); 
			$user->FULLNAME 		= $_POST['U_NAME'];
			$user->USERNAME			= $_POST['U_USERNAME'];
			$user->CONTACT			= $_POST['U_CONTACT'];
			$user->EMAIL			= $_POST['U_EMAIL'];
			if (!empty($_POST['U_PASS'])){
				$user->PASS			= sha1($_POST['U_PASS']);
			}
			$user->ROLE				= $_POST['U_ROLE'];

			//check user role if admin or staff
			//only Admin can modify other users.	
			$id = 	$_SESSION['ADMIN_USERID'];
			$mydb = new Database();
			$sql = "SELECT * FROM tblusers WHERE USERID = $id";
			$mydb->setQuery($sql);
			$res = $mydb->loadSingleResult();	
			if($_SESSION['ADMIN_ROLE'] != 'Administrator'){ //If it is not admin
				if($_POST['USERID'] == $res->USERID){ //If it is just editing its own profile
					$user->update($_POST['USERID']);

					
					message("Profile has been updated!", "success");
					redirect("index.php?view=view");
				} else {
					message("You can't modify this user. Please contact administrator.","info");
					redirect("index.php");
				}
			} else { //if it is admin
				
				$user->update($_POST['USERID']);

				if (isset($_GET['view'])) {
					message("Profile has been updated!", "success");
					redirect("index.php?view=view");
				}else{ 
					message("[". $_POST['U_NAME'] ."] has been updated!", "success");
					redirect("index.php");
				}
			}
		}
	}


	function doDelete(){
		
		// if (isset($_POST['selector'])==''){
		// message("Select the records first before you delete!","info");
		// redirect('index.php');
		// }else{

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$user = New User();
		// 	$user->delete($id[$i]);
		//$user = $_SESSION['ADMIN_USERID'];
		
				$id = 	$_GET['id'];
				$mydb = new Database();
				$sql = "SELECT * FROM tblusers WHERE USERID = $id";
				$mydb->setQuery($sql);
 				$res = $mydb->loadSingleResult();

				if ($_SESSION['ADMIN_ROLE'] != 'Administrator'){
					message("You can't modify this user. Please contact administrator.","info");
				}else{
					if($res->DELETEABLE == true){
						$user = New User();
						$user->delete($id);
						message("User has been deleted!","info");
						
					} else {
						message("You can't delete this user. Please contact main administrator.","info");
					}
				}
				redirect('index.php');
			
		// }
		// }
	}

	function doupdateimage(){
 
			$errofile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile =$_FILES['photo']['name'];
		 	$location="photos/".$myfile;


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
					move_uploaded_file($temp,"photos/" . $myfile);
		 	
					 

						$user = New User();
						$user->PICLOCATION 			= $location;
						$user->update($_SESSION['ADMIN_USERID']);
						redirect("index.php?view=view");
						 
							
					}
			}
			 
		}
 
?>