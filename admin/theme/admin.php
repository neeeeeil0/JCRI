<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php
                // $query = "SELECT * FROM `tbltitle` WHERE TItleID=1";
                // $res = mysql_query($query) or die(mysql_error());
                // $viewTitle = mysql_fetch_assoc($res);
                // echo $viewTitle['Title'];
            ?>
            JCRI | Admin Portal
        </title>
       <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo web_root;?>bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo web_root;?>plugins/font-awesome/css/font-awesome.min.css">

        <!-- <link rel="stylesheet" href="<?php echo web_root;?>plugins/dataTables/dataTables.bootstrap.css">  -->
        <!-- <link rel="stylesheet" href="<?php echo web_root;?>plugins/dataTables/jquery.dataTables.min.css">  -->

        <!-- Ionicons -->
        <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo web_root;?>dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo web_root;?>dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo web_root;?>plugins/iCheck/flat/blue.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="<?php echo web_root;?>plugins/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="<?php echo web_root;?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link href="<?php echo web_root; ?>plugins/datepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

        <link rel="stylesheet" href="<?php echo web_root;?>plugins/dataTables/jquery.dataTables.min.css">  

        <link rel="stylesheet" href="<?php echo web_root;?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        
        <script src="<?php echo web_root; ?>plugins/jQuery/jQuery-3.7.1.min.js"></script>
    </head>

 <body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo" data-toggle="offcanvas" role="button" style="background-color:#034f80;">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b><img src="<?php echo web_root; ?>admin/logohire2.png" width="25px" alt="Logo"/></b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">
        <b>JCR Inc.</b>&nbsp;
        <img src="<?php echo web_root; ?>admin/logohire2.png" width="25px" alt="Logo"/>
    </span>
</a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation" style="background-color:#034f80;">
      <!-- Sidebar toggle button
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only ">Toggle navigation</span>
      </a>-->

      <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        <?php
            $user = New User();
            $singleuser = $user->single_user($_SESSION['ADMIN_USERID']);

            if ($singleuser && isset($singleuser->PICLOCATION) && isset($singleuser->FULLNAME)) {
        ?>
        <li class="dropdown user user-menu" style="padding-right: 20px;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="display: flex; align-items: center; padding: 5px 10px; border-radius: 5px; transition: background-color 0.3s ease;">
                <img src="<?php echo web_root.'admin/user/'. $singleuser->PICLOCATION;?>" class="user-image" alt="User Image" style="margin-right: 10px; border-radius: 50%; width: 30px; height: 30px; object-fit: cover; border: 1px solid #ddd;">
                <span class="hidden-xs" style="font-weight: 500; "><?php echo $singleuser->FULLNAME; ?></span>
            </a>
            <ul class="dropdown-menu" style="border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); border: none;">
                <li class="user-header" style="background-color: #F5F5DC; padding: 20px; text-align: center; border-bottom: 1px solid #eee;">
                    <img data-target="#menuModal" data-toggle="modal" src="<?php echo web_root.'admin/user/'. $singleuser->PICLOCATION;?>" class="img-circle" alt="User Image" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.1)">
                    <p style="margin-top: 10px; font-weight: 600; color: #333; font-size: 1.2em;"><?php echo $singleuser->FULLNAME; ?>
                        <?php if (isset($singleuser->POSITION)): ?>
                            <small style="display: block; color: #777;"><?php echo $singleuser->POSITION; ?></small>
                        <?php endif; ?>
                    </p>
                </li>
                <li class="user-footer" style="background-color: #F5F5DC; padding: 10px; display: flex; justify-content: space-between;">
                    <div class="pull-left">
                        <a href="<?php echo web_root.'admin/user/index.php?view=view&id='.$_SESSION['ADMIN_USERID'] ;?>" class="btn btn-default btn-flat" style="padding: 10px 15px; border-radius: 5px; background-color: #007bff; border: none; color: white; transition: background-color 0.3s, color 0.3s; text-decoration:none; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">Profile</a>
                    </div>
                    <div class="pull-right">
                        <a href="<?php echo web_root ;?>admin/logout.php" class="btn btn-default btn-flat" style="padding: 10px 15px; border-radius: 5px; background-color: #dc3545; border: none; color: white; transition: background-color 0.3s, color 0.3s; text-decoration:none; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">Sign out</a>
                    </div>
                </li>
            </ul>
        </li>
        <?php
            }
        ?>
    </ul>
</div>
    </nav>
  </header>



 <div class="modal fade" id="menuModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal" type=
                                    "button">x</button>

                                    <h4 class="modal-title" id="myModalLabel">Image.</h4>
                                </div>

                                <form action="<?php echo web_root; ?>admin/user/controller.php?action=photos" enctype="multipart/form-data" method=
                                "post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="rows">
                                                <div class="col-md-12">
                                                    <div class="rows">
                                                        <div class="col-md-8"> 
                                                            <input class="mealid" type="hidden" name="mealid" id="mealid" value="">
                                                              <input name="MAX_FILE_SIZE" type="hidden" 
                                                              value="1000000"> 
                                                              <input id="photo" name="photo" type="file">
                                                        </div>

                                                        <div class="col-md-4"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-default" data-dismiss="modal" type=
                                        "button">Close</button> <button class="btn btn-primary"
                                        name="savephoto" type="submit">Upload Photo</button>
                                    </div>
                                </form>
                            </div><!-- /.modal-content-->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->  



  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
 
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu"> 
        <li  class="<?php echo (currentpage() == 'index.php') ? "active" : false;?>" >
          <a href="<?php echo web_root ;?>admin/">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>  
          </a> 
        </li> 
        <li class="<?php echo (currentpage() == 'company') ? "active" : false;?>" >
          <a href="<?php echo web_root ;?>admin/company/">
            <i class="fa fa-building"></i> <span>Company</span> 
          </a>
        </li>
        <li class="<?php echo (currentpage() == 'category') ? "active" : false;?>" > 
          <a href="<?php echo web_root ;?>admin/category/">
            <i class="fa fa-list"></i> <span>Classification</span>  
          </a>
        </li> 
        <li class="<?php echo (currentpage() == 'vacancy') ? "active" : false;?>" >
          <a href="<?php echo web_root ;?>admin/vacancy/">
            <i class="fa fa-suitcase"></i> <span>Vacancy</span> 
          </a>
        </li>
        <li class="<?php echo (currentpage() == 'applicants') ? "active" : false;?>" > 
          <a href="<?php echo web_root ;?>admin/applicants/">
            <i class="fa fa-users"></i> <span>Applicants</span> 
            <span class="label label-primary pull-right">
              <?php
                $sql = "SELECT count(*) as 'APPL' FROM `tbljobregistration` WHERE `PENDINGAPPLICATION`=1";
                $mydb->setQuery($sql);
                $pending = $mydb->loadSingleResult();
                echo $pending->APPL;
              ?>
            </span>
          </a>
        </li> 
        <li class="<?php echo (currentpage() == 'employee') ? "active" : false;?>" >
          <a href="<?php echo web_root ;?>admin/employee/">
            <i class="fa fa-users"></i> <span>Employees</span> 
          </a>
        </li> 
        
        
         
         <li class="<?php echo (currentpage() == 'user') ? "active" : false;?>">
          <a href="<?php echo web_root; ?>admin/user/">
            <i class="fa fa-user"></i> <span>Manage Users</span> </a>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <section class="content-header">
      <h1>
        <?php echo isset($title) ? $title : ''; ?>
        <!-- <small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <?php

          if ($title!='Home') {
            # code... 
            $active_title = '';
            if (isset($_GET['view'])) {
              # code...
              $active_title = '<li class='.$active_title.'><a href="index.php">'.$title.'</a></li>';
            }else{
              $active_title = '<li class='.$active_title.'>'.$title.'</li>';
            }
            echo '<li><a href='.web_root.'admin/><i class="fa fa-dashboard"></i> Home</a></li>';
            echo  $active_title;
            echo  isset($_GET['view']) ? '<li class="active">'.$_GET['view'].'</li>' : '';
          } 


        ?>
      </ol>
    </section>
         <section class="content">

          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">

              <?php 
               check_message();
               require_once $content; 
               ?> 
             </div>
             </div>
           </div>
         </div>
         </section>
 </div>
  <footer class="main-footer">
    <strong>Copyright &copy; 2025 <a href="#">HireVantage RMS</a>.</strong> All rights
    reserved.
  </footer>

  

    </body>
      
      <script type="text/javascript" src="<?php echo web_root; ?>bootstrap/js/bootstrap.min.js" ></script>
      <script src="<?php echo web_root;?>dist/js/app.min.js"></script> 

      <script type="text/javascript" src="<?php echo web_root; ?>plugins/datepicker/bootstrap-datepicker.js" ></script> 
      <script type="text/javascript" src="<?php echo web_root; ?>plugins/datepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
      <script type="text/javascript" src="<?php echo web_root; ?>plugins/datepicker/locales/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>

      <script type="text/javascript" src="<?php echo web_root; ?>plugins/dataTables/dataTables.bootstrap.min.js" ></script> 
      <script src="<?php echo web_root; ?>plugins/datatables/jquery.dataTables.min.js"></script> 

      <script src="<?php echo web_root; ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>

      <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>plugins/input-mask/jquery.inputmask.js"></script> 
      <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script> 
      <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>plugins/input-mask/jquery.inputmask.extensions.js"></script> 


<script>
$(function () {
  $("#dash-table").DataTable({
    "order": [[0, "desc"]] // Set the first column (index 0) to sort in descending order
  });
  $('#dash-table2').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false
  });
});

$('input[data-mask]').each(function() {
  var input = $(this);
  input.setMask(input.data('mask'));
});


$('#BIRTHDATE').inputmask({
  mask: "2/1/y",
  placeholder: "mm/dd/yyyy",
  alias: "date",
  hourFormat: "24"
});
$('#HIREDDATE').inputmask({
  mask: "2/1/y",
  placeholder: "mm/dd/yyyy",
  alias: "date",
  hourFormat: "24"
});

$('.date_picker').datetimepicker({
  format: 'mm/dd/yyyy',
  startDate : '01/01/1950', 
  language:  'en',
  weekStart: 1,
  todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1, 
  startView: 2,
  minView: 2,
  forceParse: 0 

});


</script>
</html>
 