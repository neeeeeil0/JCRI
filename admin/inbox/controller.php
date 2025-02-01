<?php
require_once ("../../include/initialize.php");
 	 if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     }


$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'delete' :
	doDelete();
	break;
	}

function doDelete(){

        $id = $_GET['id'];

        $mydb = new Database();
        $sql = "DELETE FROM tblinbox WHERE INBOXID = $id";
        $mydb->setQuery($sql);

        if ($mydb->executeQuery()){
            message("Message has been Deleted!","info");
            redirect('index.php');
        } else {
            message("Error! Message can't delete!","info");
        }
}
?>