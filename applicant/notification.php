<style type="text/css">
  .mailbox-controls .btn {
    padding: 3px 8px;
    margin: 0px 2px;
  }
  .unread {
    font-weight: bold;
    background-color: #f5f5f5;  /* Optional: Set background color for unread notifications */
  }

  .read {
    font-weight: normal;
  }

  .font-weight-bold {
    font-weight: bold;
    background-color: #f1f1f1;
  }
</style>
 <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
    
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Notification</h3>

             <!--  <div class="box-tools pull-right" style="margin-bottom: 5px;">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Notification">
                  <span class="fa fa-search form-control-feedback" style="margin-top: -25px"></span>
                </div>
              </div> -->
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
         
              <div class="table-responsive mailbox-messages">
                <?php
                  // Assuming you have the current applicant's ID stored in a session or some variable
                  $applicantID = $_SESSION['APPLICANTID'];  // This should be set after login

                  // Fetch notifications for the current applicant
                  $sql = "SELECT n.*, j.OCCUPATIONTITLE, j.JOBDESCRIPTION, j.DATEPOSTED, c.COMPANYNAME
                          FROM tblnotification n
                          JOIN tbljob j ON n.JOBID = j.JOBID
                          JOIN tblcompany c ON j.COMPANYID = c.COMPANYID
                          WHERE n.APPLICANTID = $applicantID
                          ORDER BY n.DATECREATED DESC LIMIT 10";

                  $mydb->setQuery($sql);
                  $cur = $mydb->loadResultList();

                  // Separate unread and read notifications
                  $unreadNotifications = [];
                  $readNotifications = [];

                  // Loop through all notifications and separate them
                  foreach ($cur as $result) {
                      if ($result->ISVIEWED == 0) {
                          $unreadNotifications[] = $result;
                      } else {
                          $readNotifications[] = $result;
                      }
                  }

                  // Display the notifications in the table
                  echo '<table class="table table-hover table-striped">
                          <tbody>';

                  // Unread notifications at the top
                  if (count($unreadNotifications) > 0) {
                      echo '<tr><td colspan="4" class="font-weight-bold">Unread Notifications</td></tr>';
                      foreach ($unreadNotifications as $result) {
                          echo '<tr class="unread">';
                          echo '<td class="mailbox-name">
                                  <a href="' . web_root . 'index.php?q=viewjob&search=' . $result->JOBID . '&notifID=' . $result->NOTIFICATIONID . '">
                                      ' . $result->OCCUPATIONTITLE . '
                                  </a>
                                </td>';
                          echo '<td class="mailbox-subject">' . $result->JOBDESCRIPTION . '</td>';
                          echo '<td class="mailbox-date">' . $result->DATECREATED . '</td>';
                          echo '<td class="mailbox-unread">Unread</td>';
                          echo '</tr> </tbody>';
                      }
                  }

                  // Read notifications below
                  if (count($readNotifications) > 0) {
                      echo '<tbody><tr><td colspan="4" class="font-weight-bold">Read Notifications</td></tr>';
                      foreach ($readNotifications as $result) {
                          echo '<tr class="read">';
                          echo '<td class="mailbox-name">
                                  <a href="' . web_root . 'index.php?q=viewjob&search=' . $result->JOBID . '&notifID=' . $result->NOTIFICATIONID . '">
                                      ' . $result->OCCUPATIONTITLE . '
                                  </a>
                                </td>';
                          echo '<td class="mailbox-subject">' . $result->JOBDESCRIPTION . '</td>';
                          echo '<td class="mailbox-date">' . $result->DATECREATED . '</td>';
                          echo '<td class="mailbox-read">Read</td>';
                          echo '</tr>';
                      }
                  }

                  echo '  </tbody>
                        </table>';
              ?>




                
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
     
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>