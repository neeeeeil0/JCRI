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
          <div class="box-header with-border">
            <h3 class="box-title">Notification</h3>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody id="notificationsTable">
                      <tr><td colspan="4" class="text-center">Loading notifications...</td></tr>
                  </tbody>
              </table>

                    <?php /*
                    // Assuming you have the current applicant's ID stored in a session or some variable
                    $applicantID = $_SESSION['APPLICANTID']; // This should be set after login

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

                    if (count($unreadNotifications) > 0 || count($readNotifications) > 0) {
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
                                echo '</tr>';
                            }
                        }

                        // Read notifications below
                        if (count($readNotifications) > 0) {
                            echo '<tr><td colspan="4" class="font-weight-bold">Read Notifications</td></tr>';
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
                    } else {
                        // No notifications available
                        echo '<tr><td colspan="4" class="text-center">No new notifications available</td></tr>';
                    }

                    echo '</tbody>
                          </table>'; */
                    ?>
                    
                </div><!-- /.table -->
                <!-- /.mailbox-messages -->
            </div><!-- /.box-body -->
            
        </div><!-- /. box -->


      </div><!-- /.col -->
    
    </div><!-- /.row -->
    
  </section><!-- /.content -->
  
</div>

<script>
$(document).ready(function(){
  function fetchNotifications() {
    $.ajax({
        url: "<?php echo web_root; ?>include/ajax.php",
        method: "GET",
        data: { fetchType: "notifications" },
        dataType: "json",
        success: function(response) {
            if (response.notifications) {
                let tableContent = "";
                let unread = "";
                let read = "";

                response.notifications.forEach(notification => {
                    let rowClass = notification.ISVIEWED == 0 ? "unread" : "read";
                    let status = notification.ISVIEWED == 0 ? "Unread" : "Read";
                    let notifLink = `'<?php echo web_root; ?>index.php?q=viewjob&search=${notification.JOBID}&notifID=${notification.NOTIFICATIONID}'`;

                    let row = `
                        <tr class="${rowClass}">
                            <td class="mailbox-name">
                                <a href=${notifLink}>
                                    ${notification.OCCUPATIONTITLE}
                                </a>
                            </td>
                            <td class="mailbox-subject">${notification.JOBDESCRIPTION}</td>
                            <td class="mailbox-date">${notification.DATECREATED}</td>
                            <td class="mailbox-status">${status}</td>
                        </tr>
                    `;

                    if (notification.ISVIEWED == 0) {
                        unread += row;
                    } else {
                        read += row;
                    }
                });

                // If there are notifications, separate unread and read
                if (unread !== "") {
                    tableContent += '<tr><td colspan="4" class="font-weight-bold">Unread Notifications</td></tr>' + unread;
                }
                if (read !== "") {
                    tableContent += '<tr><td colspan="4" class="font-weight-bold">Read Notifications</td></tr>' + read;
                }

                // If no notifications, show a message
                if (tableContent === "") {
                    tableContent = '<tr><td colspan="4" class="text-center">No new notifications available</td></tr>';
                }

                $("#notificationsTable").html(tableContent);
            }
        }
    });
  }
  setInterval(fetchNotifications, 1000);

  // Initial load
  fetchNotifications();
});
</script>