 <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>JCRI | <?php echo $title;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://webthemez.com" />
<!-- css -->
<link href="<?php echo web_root; ?>plugins/home-plugins/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo web_root; ?>plugins/home-plugins/css/fancybox/jquery.fancybox.css" rel="stylesheet"> 
<link href="<?php echo web_root; ?>plugins/home-plugins/css/flexslider.css" rel="stylesheet" /> 
<link href="<?php echo web_root; ?>plugins/home-plugins/css/style.css" rel="stylesheet" />
<!-- <link rel="stylesheet" href="<?php echo web_root;?>plugins/dataTables/dataTables.bootstrap.css">  --> 
<link rel="stylesheet" href="<?php echo web_root;?>plugins/font-awesome/css/font-awesome.min.css"> 

<link rel="stylesheet" href="<?php echo web_root;?>plugins/dataTables/jquery.dataTables.min.css"> 
<link rel="stylesheet" href="<?php echo web_root;?>plugins/dataTables/jquery.dataTables_themeroller.css"> 
<!-- datetime picker CSS -->
<link href="<?php echo web_root; ?>plugins/datepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<link href="<?php echo web_root; ?>plugins/datepicker/datepicker3.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="<?php echo web_root;?>plugins/dataTables/jquery.dataTables.min.css">  

<link rel="stylesheet" href="<?php echo web_root;?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<script src="<?php echo web_root; ?>plugins/jQuery/jQuery-3.7.1.min.js"></script>
 
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<style type="text/css">
 
  #content {
    min-height: 400px;
    color: #000;
  }
  
  .contentbody p {
    font-weight: bold;
  }
  .login a:hover{ 
    color: #00bcd4;
    text-decoration: none;

  }
  .login a:focus{ 
    color: #00bcd4;
    text-decoration: none;

  }
  .login a { 
     font-size: 14px;
    color: #fff;
    padding:0px;
  }
</style>

</head>
<body>
<div id="wrapper" class="home-page">
 
  <!-- start header -->
  <header>
        <div class="topbar navbar-fixed-top" style="background-color:#073763;">
          <div class="container">
            <div class="row">
              <div class="col-md-12">      
                <p class="pull-left hidden-xs"><i class="fa fa-search"></i>HireVantage RMS</p>
                <?php if (isset($_SESSION['APPLICANTID'])) { 

                  // Count unread notifications for the applicant
                  $sql = "SELECT count(*) as 'COUNTNOTIF' 
                          FROM `tblnotification` n 
                          WHERE n.APPLICANTID = {$_SESSION['APPLICANTID']} 
                          AND n.ISVIEWED = 0";
                  $mydb->setQuery($sql);
                  $showNotif = $mydb->loadSingleResult();
                  $notif = isset($showNotif->COUNTNOTIF) ? $showNotif->COUNTNOTIF : 0;

                  // Get applicant details
                  $applicant = new Applicants();
                  $appl = $applicant->single_applicant($_SESSION['APPLICANTID']);

                  // Count unread messages for the applicant
                  $sql = "SELECT COUNT(*) as 'COUNT' FROM `tblcompany` c, `tbljobregistration` j, `tblfeedback` f 
                        WHERE c.`COMPANYID` = j.`COMPANYID` 
                        AND j.`REGISTRATIONID` = f.`REGISTRATIONID`
                        AND f.VIEW = 1
                        AND j.`APPLICANTID` = '{$appl->APPLICANTID}'";
                  $mydb->setQuery($sql);
                  $showMsg = $mydb->loadSingleResult();
                  $msg = isset($showMsg->COUNT) ? $showMsg->COUNT : 0;?>

                  <p class="pull-right login">
                      <a title="View Notification(s)" href="<?php echo web_root ?>applicant/index.php?view=notification">
                          <i class="fa fa-bell-o"></i> 
                          <span id="notifCount" class="label label-success">0<?php //echo $notif ?></span>
                      </a> | 
                      <a title="View Message(s)" href="<?php echo web_root ?>applicant/index.php?view=message">
                          <i class="fa fa-envelope-o"></i> 
                          <span id="messageCount" class="label label-success">0<?php //echo $showMsg ?></span>
                      </a> | 
                      <a title="View Profile" href="<?php echo web_root ?>applicant/"> 
                          <i class="fa fa-user"></i><?php echo ' Hi, '.$appl->FNAME . ' ' . $appl->LNAME?>
                      </a> | 
                      <a href="<?php echo web_root ?>logout.php">  
                          <i class="fa fa-sign-out"></i>Logout
                      </a>
                  </p>

                  <?php
                  } else { ?>
                  <p class="pull-right login">
                      <a data-target="#myModal" data-toggle="modal" href=""> 
                          <i class="fa fa-lock"></i> Login 
                      </a>
                  </p>
                  <?php } ?>

              
              </div>
            </div>
          </div>
        </div> 
        <div style="min-height: 30px;"></div>
        <div class="navbar navbar-default navbar-static-top"> 
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo web_root; ?>index.php" style="font-size: 20px;"><img src="<?php echo web_root; ?>plugins/home-plugins/img/slides/logo2.png" alt="logo" style="width: 50px; height: auto; filter: drop-shadow(0px 4px 6px rgba(0, 0, 0, 0.25));"/> &nbsp;Job Connect Resources Inc.</a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo !isset($_GET['q'])? 'active' :''?>"><a href="<?php echo web_root; ?>index.php">Home</a></li>
                        <li class="<?php  if(isset($_GET['q'])) { if($_GET['q']=='jobsearch'){ echo 'active'; }else{ echo ''; }}  ?>"><a href="<?php echo web_root; ?>index.php?q=jobsearch">Job Search</a></li>
                        <!--
                        <li class="dropdown">
                          <a href="#" data-toggle="dropdown" class="dropdown-toggle">Job Search <b class="caret"></b></a>
                          <ul class="dropdown-menu">
                              <li class="<?php  if(isset($_GET['q'])) { if($_GET['q']=='advancesearch'){ echo 'active'; }else{ echo ''; }}  ?>"><a href="<?php echo web_root; ?>index.php?q=advancesearch">Advance Search</a></li>
                              <li><a href="<?php echo web_root; ?>index.php?q=search-company">Job By Company</a></li>
                              <li><a href="<?php echo web_root; ?>index.php?q=search-function">Job By Function</a></li>
                              <li><a href="<?php echo web_root; ?>index.php?q=search-jobtitle">Job By Title</a></li>
                          </ul>
                       </li> -->
                      <!--
                      <li class="dropdown <?php  if(isset($_GET['q'])) { if($_GET['q']=='category'){ echo 'active'; }else{ echo ''; }}  ?>">
                          <a href="#" data-toggle="dropdown" class="dropdown-toggle">Popular Jobs <b class="caret"></b></a>
                          <ul class="dropdown-menu">
                            <?php 
                            $sql = "SELECT * FROM `tblcategory` LIMIT 10";
                            $mydb->setQuery($sql);
                            $cur = $mydb->loadResultList();

                            foreach ($cur as $result) {
                              # code...

                                if (isset($_GET['search'])) {
                                  # code...
                                   if ($result->CATEGORY==$_GET['search']) {
                                     # code...
                                    $viewresult = '<li class="active"><a href="'.web_root.'index.php?q=category&search='.$result->CATEGORY.'">'.$result->CATEGORY.' Jobs</a></li>';
                                   }else{
                                    $viewresult = '<li><a href="'.web_root.'index.php?q=category&search='.$result->CATEGORY.'">'.$result->CATEGORY.' Jobs</a></li>';
                                   }
                                }else{
                                    $viewresult = '<li><a href="'.web_root.'index.php?q=category&search='.$result->CATEGORY.'">'.$result->CATEGORY.' Jobs</a></li>';
                                } 

                                echo $viewresult;

                              }

                            ?> 
                          </ul>
                       </li>
                            -->
                        <li class="<?php  if(isset($_GET['q'])) { if($_GET['q']=='company'){ echo 'active'; }else{ echo ''; }}  ?>"><a href="<?php echo web_root; ?>index.php?q=company">Company</a></li>

                        <li class="<?php  if(isset($_GET['q'])) { if($_GET['q']=='About'){ echo 'active'; }else{ echo ''; }}  ?>"><a href="<?php echo web_root; ?>index.php?q=About">About Us</a></li>
                        <li class="<?php  if(isset($_GET['q'])) { if($_GET['q']=='Contact'){ echo 'active'; }else{ echo ''; }}  ?>"><a href="<?php echo web_root; ?>index.php?q=Contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
  </header>
 

  <?php
    if (!isset($_SESSION['APPLICANTID'])) { 
      include("login.php");
    }
  ?>
      <?php

      if (isset($_GET['q'])) {
        # code...
        echo '<section id="inner-headline" style="background-color:#085394; height: 100px; padding: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="pageTitle">'.$title.'</h2>
                    </div>
                </div>
            </div>
            </section>';
      }


       require_once $content;

        ?>   
 

  <footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="widget">
          <h5 class="widgetheading">Our Contact</h5>
          <address>

          Room 529, 531 & 533 5th Floor, J & T Bldg,
           3894 Magsaysay Blvd, Santa Mesa, Manila, 1008 Metro Manila,
            Manila, Philippines</address>
          <p>
            <i class="icon-phone"></i> 0995 785 9809 <br>
            <i class="icon-envelope-alt"></i> careers.jobconnect@gmail.com
          </p>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="widget">
          <h5 class="widgetheading">Quick Links</h5>
          <ul class="link-list">
            <li><a href="<?php echo web_root; ?>index.php">Home</a></li>
            <li><a href="<?php echo web_root; ?>index.php?q=jobsearch">Job Search</a></li>
            <li><a href="<?php echo web_root; ?>index.php?q=company">Company</a></li>

            <li><a href="<?php echo web_root; ?>index.php?q=About">About us</a></li>
            <li><a href="<?php echo web_root; ?>index.php?q=Contact">Contact us</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="widget">
          <h5 class="widgetheading">Latest posts</h5>
          <ul class="link-list">
            <?php 
                  $sql = "SELECT * FROM `tblcompany` c,`tbljob` j WHERE c.`COMPANYID`=j.`COMPANYID`   ORDER BY DATEPOSTED DESC LIMIT 3" ;
                  $mydb->setQuery($sql);
                  $cur = $mydb->loadResultList();


                  foreach ($cur as $result) {
                    echo ' <li><a href="'.web_root.'index.php?q=viewjob&search='.$result->JOBID.'">'.$result->OCCUPATIONTITLE. ' - '. $result->COMPANYNAME .'</a></li>';
                  } 
              ?> 
          </ul>
        </div>
      </div>
<!--       <div class="col-md-3 col-sm-3">
        <div class="widget">
          <h5 class="widgetheading">Recent News</h5>
          <ul class="link-list">
            <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>
            <li><a href="#">Pellentesque et pulvinar enim. Quisque at tempor ligula</a></li>
            <li><a href="#">Natus error sit voluptatem accusantium doloremque</a></li>
          </ul>
        </div>
      </div> -->
    </div>
  </div>
  <div id="sub-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="copyright">
            <p>
              <span>&copy; HireVantage RMS 2025 All right reserved.  
            </p>
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="social-network">
            <li><a href="https://web.facebook.com/jobconnect.ph" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://www.linkedin.com/in/kimjero-jangayo-20b178249/?originalSubdomain=ph" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
            <!--<li><a href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
            <li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li>-->
          </ul>
        </div>
      </div>
    </div>
  </div>
  </footer>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo web_root; ?>plugins/home-plugins/js/jquery.js"></script>
<script src="<?php echo web_root; ?>plugins/home-plugins/js/jquery.easing.1.3.js"></script>
<script src="<?php echo web_root; ?>plugins/home-plugins/js/bootstrap.min.js"></script>
 

<script type="text/javascript" src="<?php echo web_root; ?>plugins/dataTables/dataTables.bootstrap.min.js" ></script>  
<script src="<?php echo web_root; ?>plugins/datatables/jquery.dataTables.min.js"></script> 

<script type="text/javascript" src="<?php echo web_root; ?>plugins/datepicker/bootstrap-datepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo web_root; ?>plugins/datepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo web_root; ?>plugins/datepicker/locales/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>

<script type="text/javascript" language="javascript" src="<?php echo web_root; ?>plugins/input-mask/jquery.inputmask.js"></script> 
<script type="text/javascript" language="javascript" src="<?php echo web_root; ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script> 
<script type="text/javascript" language="javascript" src="<?php echo web_root; ?>plugins/input-mask/jquery.inputmask.extensions.js"></script> 

<script src="<?php echo web_root; ?>plugins/home-plugins/js/jquery.fancybox.pack.js"></script>
<script src="<?php echo web_root; ?>plugins/home-plugins/js/jquery.fancybox-media.js"></script>  
<script src="<?php echo web_root; ?>plugins/home-plugins/js/jquery.flexslider.js"></script>
<script src="<?php echo web_root; ?>plugins/home-plugins/js/animate.js"></script>


<!-- Vendor Scripts -->
<script src="<?php echo web_root; ?>plugins/home-plugins/js/modernizr.custom.js"></script>
<script src="<?php echo web_root; ?>plugins/home-plugins/js/jquery.isotope.min.js"></script>
<script src="<?php echo web_root; ?>plugins/home-plugins/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo web_root; ?>plugins/home-plugins/js/animate.js"></script>
<script src="<?php echo web_root; ?>plugins/home-plugins/js/custom.js"></script> 
<!-- <script src="<?php echo web_root; ?>plugins/paralax/paralax.js"></script>  -->

<!-- Unread Messages -->
<a title="View Message(s)" href="<?php echo web_root; ?>applicant/index.php?view=message">
    <i class="fa fa-envelope-o"></i>
    <span id="messageCount" class="label label-success"><?php echo $msg; ?></span>
</a>

<!-- Unread Notifications -->
<a title="View Notification(s)" href="<?php echo web_root; ?>applicant/index.php?view=notification">
    <i class="fa fa-bell-o"></i>
    <span id="notifCount" class="label label-success"><?php echo $notif; ?></span>
</a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){
    function updateCounts() {
        $.ajax({
            url: "<?php echo web_root; ?>include/ajax.php",
            method: "GET",
            data: { fetchType: "count" },
            dataType: "json",
            success: function(response) {
                if (response.messages !== undefined) {
                    $("#messageCount").text(response.messages); // Update messages count
                }
                if (response.notifications !== undefined) {
                    $("#notifCount").text(response.notifications); // Update notifications count
                }
            }
        });
    }

    // Update counts every 5 seconds
    setInterval(updateCounts, 1000);

    // Initial fetch on page load
    updateCounts();
});
</script>


 <script type="text/javascript">
   
     $(function () {
    $("#dash-table").DataTable();
    $('#dash-table2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });


     $("#btnlogin").click(function(){
        var username = document.getElementById("user_email");
        var pass = document.getElementById("user_pass");

        // alert(username.value)
        // alert(pass.value)
        if(username.value=="" && pass.value==""){   
          $('#loginerrormessage').fadeOut(); 
                $('#loginerrormessage').fadeIn();  
                $('#loginerrormessage').css({ 
                        "background" :"red",
                        "color"      : "#fff",
                        "padding"    : "5px;"
                    }); 
          $("#loginerrormessage").html("Invalid Username and Password!");
          //  $("#loginerrormessage").css(function(){ 
          //   "background-color" : "red";
          // });
        }else{

          $.ajax({    //create an ajax request to load_page.php
              type:"POST",  
              url: "process.php?action=login",    
              dataType: "text",  //expect html to be returned  
              data:{USERNAME:username.value,PASS:pass.value},               
              success: function(data){   
                // alert(data);
                $('#loginerrormessage').fadeOut(); 
                $('#loginerrormessage').fadeIn();  
                $('#loginerrormessage').css({ 
                        "background" :"red",
                        "color"      : "#fff",
                        "padding"    : "5px;"
                    }); 
               $('#loginerrormessage').html(data);   
              } 
              }); 
          }
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
 
</body>
</html>
 