<section id="content">
  <div class="container content">     
    <?php
    if (isset($_GET['job'])) {
        $jobid = $_GET['job'];
    } else {
        $jobid = '';
    }
    $sql = "SELECT * FROM `tblcompany` c,`tbljob` j WHERE c.`COMPANYID`=j.`COMPANYID` AND JOBID = $jobid ORDER BY DATEPOSTED DESC";
    $mydb->setQuery($sql);
    $result = $mydb->loadSingleResult();
    ?>

    <p> <?php check_message();?></p>     

    <?php 
    $userApplied = false;
    $uploadedFileName = '';

    if (isset($_SESSION['APPLICANTID'])) {
        $applicantId = $_SESSION['APPLICANTID'];
        $jobId = $result->JOBID;

        // Query to check if application exists and get file name
        $checkApplicationQuery = "SELECT * FROM `tblattachmentfile` WHERE `USERATTACHMENTID` = '$applicantId' AND `JOBID` = '$jobId'";
        $mydb->setQuery($checkApplicationQuery);
        $resultSet = $mydb->executeQuery();
        
        if ($mydb->num_rows($resultSet) > 0) {
            $userApplied = true;
            $row = $mydb->fetch_array($resultSet); // Fetch the first matching row
            $filelocation = $row['FILE_LOCATION'];
            $uploadedFileName = $row['FILE_NAME']; // Get the file name
        }
    ?>

    <div class="col-sm-12">
        <div class="row">
            <h2 class="">Job Details</h2>
            <div class="panel">
                <div class="panel-header">
                    <div style="border-bottom: 1px solid #ddd; padding: 10px; font-size: 25px; font-weight: bold; color: #000; margin-bottom: 5px;">
                        <a href="<?php echo web_root.'index.php?q=viewjob&search='.$result->JOBID; ?>">
                            <?php echo $result->OCCUPATIONTITLE; ?>
                        </a>
                        <p style="font-size: 14px; font-weight: normal; margin: 5px 0 0;">
                            &nbsp;<?php echo $result->COMPANYNAME; ?>, <?php echo $result->COMPANYADDRESS; ?>
                        </p>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row contentbody">
                        <div class="col-sm-6">
                            <p>Job Details:</p>
                            <ul>
                                <li><i class="fp-ht-food"></i>Job Setting : <?php echo $result->JOBSETTING; ?></li>
                                <li><i class="fp-ht-food"></i>Salary : ₱ <?php echo number_format($result->SALARIES,2); ?></li>
                                <li><i class="fp-ht-tv"></i>Preferred Sex : <?php echo $result->PREFEREDSEX; ?></li>
                            </ul>
                        </div>

                        <div class="col-sm-12">
                            <p>Qualification/Work Experience:</p>
                            <ul style="list-style: none;">
                                <li><?php echo $result->QUALIFICATION_WORKEXPERIENCE; ?></li>
                            </ul> 
                        </div>
                        <div class="col-sm-12">
                            <p>Job Description:</p>
                            <ul style="list-style: none;">
                                <li><?php echo $result->JOBDESCRIPTION; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    Date Posted : <?php echo date_format(date_create($result->DATEPOSTED),'M d, Y'); ?>
                </div>
            </div>
        </div>
    </div>

    <form class="form-horizontal span6" action="process.php?action=submitapplication&JOBID=<?php echo $result->JOBID; ?>" enctype="multipart/form-data" method="POST">
        <div class="col-sm-12">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-header">
                        <div style="border-bottom: 1px solid #ddd;padding: 10px;font-size: 25px;font-weight: bold;color: #000;margin-bottom: 5px;">
                            <?php if ($userApplied): ?>
                                Attached File: <strong><a href="<?php echo web_root . 'applicant/' . $filelocation; ?>" target="_blank">
                                    <?php echo htmlspecialchars($uploadedFileName); ?></a></strong>
                            <?php else: ?>
                                Attach your Resume here.
                                <input name="JOBID" type="hidden" value="<?php echo $_GET['job']; ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if (!$userApplied): ?>
                    <div class="panel-body"> 
                        <label class="col-md-2" for="picture" style="padding: 0;margin: 0;">Attachment File:</label> 
                        <div class="col-md-10" style="padding: 0;margin: 0;">
                            <input id="picture" name="picture" type="file">
                            <input name="MAX_FILE_SIZE" type="hidden" value="1000000"> 
                        </div> 
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <?php if ($userApplied): ?>
                    <button class="btn btn-secondary btn-sm pull-right" disabled><strong>Applied</strong></button>
                <?php else: ?>
                    <button class="btn btn-primary btn-sm pull-right" name="submit" type="submit"><strong>Submit <span class="fa fa-arrow-right"></span></strong></button>
                <?php endif; ?>
                <a href="#" onclick="window.history.go(-1); return false;" class="btn btn-info">
                    <span class="fa fa-arrow-left"></span><strong> Back</strong>
                </a>
            </div>
        </div> 
    </form>
    
    <?php } else { ?>
    <form class="form-horizontal span6 wow fadeInDown" action="process.php?action=submitapplication&JOBID=<?php echo $result->JOBID; ?>" enctype="multipart/form-data" method="POST">
        <div class="col-sm-8"> 
            <div class="row">
                <h2 class="">Personal Info</h2>   
                    <?php require_once('applicantform.php') ?>   
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <h2 class="">Job Details</h2>
                <div class="panel">
                    <div class="panel-header">
                        <div style="border-bottom: 1px solid #ddd;padding: 10px;font-size: 25px;font-weight: bold;color: #000;margin-bottom: 5px;">
                            <a href="<?php echo web_root.'index.php?q=viewjob&search='.$result->JOBID;?>"><?php echo $result->OCCUPATIONTITLE; ?></a> 
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row contentbody">
                            <div class="col-sm-12">
                                <p>Job Details:</p>
                                <ul>
                                    <li><i class="fp-ht-tv"></i>Job Setting : <?php echo $result->JOBSETTING; ?></li>
                                    <li><i class="fp-ht-food"></i>Salary : ₱ <?php echo number_format($result->SALARIES, 2); ?></li>
                                    <li><i class="fp-ht-tv"></i>Preferred Sex : <?php echo $result->PREFEREDSEX; ?></li>
                                </ul>
                            </div>
                            <div class="col-sm-12">
                                <p>Qualification/Work Experience:</p>
                                <ul style="list-style: none;">
                                    <li><?php echo $result->QUALIFICATION_WORKEXPERIENCE; ?></li> 
                                </ul> 
                            </div>
                            <div class="col-sm-12"> 
                                <p>Job Description:</p>
                                <ul style="list-style: none;"> 
                                    <li><?php echo $result->JOBDESCRIPTION; ?></li> 
                                </ul> 
                            </div>
                            <div class="col-sm-12">
                                <p>Employer : <?php echo $result->COMPANYNAME; ?></p> 
                                <p>Location : <?php echo $result->COMPANYADDRESS; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        Date Posted : <?php echo date_format(date_create($result->DATEPOSTED), 'M d, Y'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-header">
                        <div style="border-bottom: 1px solid #ddd;padding: 10px;font-size: 25px;font-weight: bold;color: #000;margin-bottom: 5px;">
                            Attach your Resume here.
                        </div>
                    </div>
                    <div class="panel-body"> 
                        <label class="col-md-2" for="picture" style="padding: 0;margin: 0;">Attachment File:</label> 
                        <div class="col-md-10" style="padding: 0;margin: 0;">
                            <input id="picture" name="picture" type="file">
                            <input name="MAX_FILE_SIZE" type="hidden" value="1000000"> 
                        </div> 
                    </div>
                </div> 
            </div> 
        </div>

        <div class="form-group">
            <div class="col-md-12"> 
                <button class="btn btn-primary btn-sm pull-right" name="submit" type="submit">Submit <span class="fa fa-arrow-right"></span></button>
                <a href="index.php" class="btn btn-info"><span class="fa fa-arrow-left"></span>&nbsp;<strong>Back</strong></a> 
            </div>
        </div>   
    </form> 
    <?php } ?>
  </div> 
</section> 
