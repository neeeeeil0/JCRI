<?php 
require_once("../include/initialize.php");
 if(!isset($_SESSION['ADMIN_USERID'])){
    redirect(web_root."admin/login.php");
  }

$content='home.php';
$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
switch ($view) {
  case '1' :
        // $title="Home"; 
    // $content='home.php'; 
    if ($_SESSION['ADMIN_ROLE']=='Cashier') {
        # code...
      redirect('orders/');

    } 
    if ($_SESSION['ADMIN_ROLE']=='Administrator') {
        # code... 

      redirect('meals/');

    } 
    break;  
  default :
<<<<<<< HEAD
    //$title="Home"; 
    //$content ='home.php';
    redirect('dashboard/');
=======
    $title="Dashboard"; 
    $content ='home.php';    
>>>>>>> ebb5a44d41f4d530cb146c363a6971ef633b6fd8
}
require_once("theme/admin.php");
?>