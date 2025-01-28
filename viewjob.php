<section id="content">
    <div class="container content" style="max-width: 800px; margin: 0 auto;">      
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
            $jobid = $_GET['search'];
        } else {
            $jobid = '';
        }

        $sql = "SELECT * FROM `tblcompany` c,`tbljob` j WHERE c.`COMPANYID`=j.`COMPANYID` AND JOBID = $jobid ORDER BY DATEPOSTED DESC";
        $mydb->setQuery($sql);
        $cur = $mydb->loadResultList();

        foreach ($cur as $result) {
        ?> 
        <div style="padding: 20px; margin-bottom: 20px;">
            <h5 style="color: #555;">Date Posted: <span style="color: #3498db;"><?php echo date_format(date_create($result->DATEPOSTED), 'M d, Y'); ?></span></h5>
            <div class="row">
                <div class="col-sm-2" style="text-align: center;">
                    <a href="#"><span class="fa fa-building-o" style="font-size: 50px; color: #555;"></span></a>
                </div>
                <div class="col-sm-10">
                    <h3 style="font-weight: bold; color: #333; margin: 0;">
                        <?php echo $result->OCCUPATIONTITLE; ?>
                        <?php if ($result->JOBSTATUS != 'Open') { ?>
                            <small style="color: #e74c3c; font-size: 15px;">(<?php echo $result->JOBSTATUS; ?>)</small>
                        <?php } ?>
                    </h3>
                    <p style="font-size: 16px; margin: 5px 0; color: #777;">
                        <?php echo $result->COMPANYNAME; ?>, <?php echo $result->COMPANYADDRESS; ?>
                    </p>
                </div>
            </div>
            <hr style="border: 1px solid #ddd; margin: 15px 0;">
            <div class="row">
                <div class="col-sm-6">
                    <p><strong>Job Details:</strong></p>
                    <ul style="list-style: none; padding: 0 0 0 20px; margin: 0;">
                        <li style="text-indent: 10px;">Job Setting: <?php echo $result->JOBSETTING; ?></li>
                        <li style="text-indent: 10px;">Salary: ₱ <?php echo number_format($result->SALARIES, 2); ?></li>
                        <li style="text-indent: 10px;">Preferred Sex: <?php echo $result->PREFEREDSEX; ?></li>
                    </ul>
                    <br>
                    <p><strong>Qualification/Work Experience:</strong></p>
                    <p style="padding: 0 0 0 30px; margin: 0;"><?php echo $result->QUALIFICATION_WORKEXPERIENCE; ?></p>
                </div>
                
                <div class="col-sm-12"><br>
                    <p><strong>Job Description:</strong></p>
                    <p style="padding: 0 0 0 30px; margin: 0;"><?php echo $result->JOBDESCRIPTION; ?></p>
                </div>
            </div>
            <?php if ($result->JOBSTATUS == 'Open') { ?>
                <a href="<?php echo web_root; ?>index.php?q=apply&job=<?php echo $result->JOBID; ?>" 
                    style="display: inline-block; margin-top: 15px; padding: 10px 20px; background-color: #3498db; color: #fff; text-decoration: none; border-radius: 4px; text-align: center; transition: background-color 0.3s ease;" 
                    onmouseover="this.style.backgroundColor='#2980b9'" 
                    onmouseout="this.style.backgroundColor='#3498db'">
                    Apply Now!
                </a>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
</section>
