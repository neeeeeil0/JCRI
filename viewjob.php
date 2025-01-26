
    <section id="content">
        <div class="container content">      
     
 <?php
 $red_id = isset($_GET['id']) ? $_GET['id'] : '';

 // Check if a notification ID is passed in the query string
 if (isset($_GET['notifID'])) {
     $notifID = $_GET['notifID'];
     // Update the IsViewed status to 1 (viewed) for the specific notification
     $updateSql = "UPDATE tblnotification 
                 SET ISVIEWED = 1 
                 WHERE NOTIFICATIONID = $notifID";
     $mydb->setQuery($updateSql);
     $mydb->executeQuery();
 }

 if (isset($_GET['search'])) {
     # code...
    $jobid = $_GET['search'];
 }else{
     $jobid = '';

 }
    $sql = "SELECT * FROM `tblcompany` c,`tbljob` j WHERE c.`COMPANYID`=j.`COMPANYID` AND JOBID = $jobid ORDER BY DATEPOSTED DESC" ;
    $mydb->setQuery($sql);
    $cur = $mydb->loadResultList();


    foreach ($cur as $result) {
        
        
  ?> 
           <div class="container">
             <div class="mg-available-rooms">
                    <h5 class="mg-sec-left-title">Date Posted :  <?php echo date_format(date_create($result->DATEPOSTED),'M d, Y'); ?></h5>
                        <div class="mg-avl-rooms">
                            <div class="mg-avl-room">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <a href="#"><span class="fa fa-building-o" style="font-size: 50px"></span><!-- <img src="img/room-1.png" alt="" class="img-responsive"> --></a>
                                    </div>
                                    <div class="col-sm-10">
                                        <div style="border-bottom: 1px solid #ddd;padding: 10px;">
                                        <p style="font-size: 25px;font-weight: bold;color: #000;margin-bottom: 5px;">
                                            <?php echo $result->OCCUPATIONTITLE ;?>
                                            <?php if ($result->JOBSTATUS != 'Open') { ?>
                                                <small style="font-size: 15px; ;color:#f66e6e;margin-bottom: 5px;">(<?php echo $result->JOBSTATUS; ?>)</small>
                                            <?php } ?>  
                                                <p><?php echo  $result->COMPANYNAME; ?>
                                                , <?php echo  $result->COMPANYADDRESS; ?></p>
                                            
                                    </div> 
                                        <br>
                                        <div class="row contentbody">
                                            <div class="col-sm-6">
                                            <p style="text-indent: 10px;">Job Details:</p>
                                                <ul>
                                                    <li><i class="fp-ht-food"></i>Job Setting : <?php echo $result->JOBSETTING;  ?></li>
                                                    <li><i class="fp-ht-food"></i>Salary : ₱ <?php echo number_format($result->SALARIES,2);  ?></li>
                                                    <li><i class="fp-ht-tv"></i>Prefered Sex : <?php echo $result->PREFEREDSEX; ?></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6">
                                                <ul>
                                                    <!-- <li><i class="fp-ht-dumbbell"></i>Qualification/Work Experience : <?php echo $result->QUALIFICATION_WORKEXPERIENCE; ?></li> -->
                                                </ul>
                                            </div>
                                            <div class="col-sm-12">
                                                <p style="text-indent: 10px;">Qualification/Work Experience :</p>
                                                 <ul style="list-style: none;"> 
                                                    <li><?php echo $result->QUALIFICATION_WORKEXPERIENCE ;?></li> 
                                                </ul> 
                                            </div>
                                            <div class="col-sm-12"> 
                                                <p style="text-indent: 10px;">Job Description:</p>
                                                <ul style="list-style: none;"> 
                                                     <li><?php echo $result->JOBDESCRIPTION ;?></li> 
                                                </ul> 
                                            </div>
                                            
                                        </div>
                                        <?php
                                        if ($result->JOBSTATUS == 'Open') {
                                        ?>
                                        <a href="<?php echo web_root; ?>index.php?q=apply&job=<?php echo $result->JOBID;?>" 
                                            style="display: inline-block; margin-top: 10px; margin-left: 10px; padding: 10px 20px; background-color: #3498db; color: #fff; text-decoration: none; border-radius: 4px; font-size: 14px; text-align: center; transition: background-color 0.3s ease;" 
                                            onmouseover="this.style.backgroundColor='#2980b9'" 
                                            onmouseout="this.style.backgroundColor='#3498db'">
                                            Apply Now!
                                        </a>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
            </div>                        

     
<?php  } ?>    </div>
    </section> 