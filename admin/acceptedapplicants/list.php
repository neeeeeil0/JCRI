<?php 
	  if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     } 
?>

<div class="row">
		<div class="col-lg-12">
		<h1 class="page-header">List of Hired Applicants</h1>
	</div>
</div>
	<form action="controller.php?action=delete" Method="POST">  	
		<div class="table-responsive">					
			<table id="accepted-list" class="table table-striped table-bordered table-hover"  style="font-size:14px;width:100%" cellspacing="0">
				<thead>
					<tr>
						<th>Employee ID</th>
						<th>Name</th> 
						<th>Company Name</th> 
						<th>Job Title</th>
						<th>Hired Date</th>
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
        dataTable = $('#accepted-list').DataTable({
            "processing": false,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "ajax.php",
                type: "POST",
            },
            "columnDefs": [
                {
                    "targets": [5],
                    "orderable": false,
                },
            ],
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


