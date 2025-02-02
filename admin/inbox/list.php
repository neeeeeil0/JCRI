<?php 
	  if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     } 
?>

<div class="row">
		<div class="col-lg-12">
		<h1 class="page-header">List of Mails</h1>
	</div>
</div>
	<form action="controller.php?action=delete" Method="POST">  	
		<div class="table-responsive">					
			<table id="inbox-list" class="table table-striped table-bordered table-hover"  style="font-size:14px" cellspacing="0">
			
				<thead>
					<tr>
						<th>Full Name</th> 
						<th>Email</th> 
						<th>Message</th>
						<th>Date</th>
							<th width="10%" align="center">Action</th>
					</tr>	
				</thead> 
				<tbody>
					
				</tbody>
			</table>
		</div>
	</form>

	<script type="text/javascript">
$(document).ready(function () {

    var dataTable;

    function load_data() {
        dataTable = $('#inbox-list').DataTable({
            "processing": false,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?php echo web_root?>/admin/inbox/ajax.php",
                type: "POST",
            },
            "columnDefs": [
                {
                    "targets": [4],
                    "orderable": false,
                },
            ],
			"createdRow": function (row, data, dataIndex) {
                if (data['VIEW'] === true || data['VIEW'] == 1) { // Check for pending applications
                    $(row).css("font-weight", "bold"); // Apply bold styling
                }
            },
            "destroy": true // Ensure the table can be refreshed without errors
        });
    }

    // Initialize DataTable
    load_data();

    setInterval(function () {
        dataTable.ajax.reload(null, false); // Reload the table without resetting the paging
    }, 1000);
});
</script>