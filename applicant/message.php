  <style type="text/css">
    .mailbox-controls .btn {
      padding: 3px 8px;
      margin: 0px 2px;
    }
  </style>
<?php 
if (!isset($_GET['p'])) {
  # code... 
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
    
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Messages</h3>

              <div class="box-tools pull-right" style="margin-bottom: 5px;">
                <div class="has-feedback">
                  <input id="searchMail" type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="fa fa-search form-control-feedback" style="margin-top: -25px"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <!-- <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button> -->
                <div class="btn-group">
                  <!-- <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button> -->
              <!--     <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button> -->
                </div>
                <!-- /.btn-group -->
                <!-- <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button> -->
              <!--   <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div> 
                </div> -->
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
              <table id="messages-list" class="table table-hover table-striped">
                <tbody>
                    <?php /*
                        $sql = "SELECT * FROM `tblcompany` c, `tbljobregistration` j, `tblfeedback` f 
                        WHERE c.`COMPANYID` = j.`COMPANYID` 
                        AND j.`REGISTRATIONID` = f.`REGISTRATIONID` 
                        AND `PENDINGAPPLICATION` = 0 
                        AND j.`APPLICANTID` = '{$_SESSION['APPLICANTID']}' ORDER BY f.`DATETIMESAVED` DESC";
                        $mydb->setQuery($sql);
                        $cur = $mydb->loadResultList();
                        
                        if (empty($cur)) {
                            echo '<tr>';
                            echo '<td colspan="4" class="text-center">No new messages available.</td>';
                            echo '</tr>';
                        } else {
                            foreach ($cur as $result) {
                                $rowStyle = ($result->VIEW == 1) ? 'font-weight: bold;' : '';
                                echo '<tr style="' . $rowStyle . '">';
                                //echo '<td><input type="checkbox"></td>';
                                echo '<td class="mailbox-name"><a href="index.php?view=message&p=readmessage&id='.$result->FEEDBACKID.'">'.$result->COMPANYNAME.'</a></td>';
                                echo '<td class="mailbox-subject">'.$result->FEEDBACK.'</td>'; 
                                echo '<td class="mailbox-date">'.$result->DATETIMEAPPROVED.'</td>';
                                echo '</tr>';
                            }
                        }*/
                    ?>
                    <td colspan="3" class="text-center">Processing...</td>
                </tbody>
              </table>

                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <!-- <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i> </button>-->
                <!--<div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                   <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button> 
                </div>-->
                <!-- /.btn-group -->
                <a href="index.php?view=message" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
                <div id="pagination-container" class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                   <!--/.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
   
 <?php }else{  
  require_once('readmessage.php');
 } ?>

<script>
$(document).ready(function(){
    let currentPage = 1;

    function loadMessages(query = '', page = 1) {
        $.ajax({
            url: "<?php echo web_root;?>include/ajax.php",
            method: "GET",
            data: { query: query, page: page },
            dataType: "json",
            success: function(response) {
                $("#messages-list tbody").html(response.messages); // Update table
                $("#pagination-container").html(response.pagination); // Update pagination
                currentPage = page;
            }
        });
    }

    // Load messages every second
    setInterval(function() {
        let query = $("#searchMail").val();
        loadMessages(query, currentPage);
    }, 1000);

    // Load messages when typing in the search box
    $("#searchMail").on("keyup", function() {
        let query = $(this).val();
        loadMessages(query, 1); // Reset to page 1 when searching
    });

    // Pagination click event
    $(document).on("click", ".prev-page, .next-page", function() {
        let page = $(this).data("page");
        let query = $("#searchMail").val();
        loadMessages(query, page);
    });

    // Initial load
    loadMessages();
});
</script>

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