<?php
	 if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     }

	 if ($_SESSION["ADMIN_ROLE"] != 'Administrator'){
		
		redirect("../../admin/index.php");
	}
?> 
       	 <div class="col-lg-12">
            <h1 class="page-header">List of Users  <a href="index.php?view=add" class="btn btn-primary btn-xs  ">  <i class="fa fa-plus-circle fw-fa"></i> Add User</a>  </h1>
       	</div>
        	<!-- /.col-lg-12 --> 
   		 	<div class="col-lg-12"> 
				<table id="users-list" class="table table-striped table-bordered table-hover"  style="font-size:14px;width:100%" cellspacing="0">
				  <thead>
				  	<tr>
				  		<th>Account ID</th>
				  		<th>Account Name</th>
				  		<th>Username</th>
				  		<th>Role</th>
				  		<th width="10%" >Action</th>
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php /*
				  		// $mydb->setQuery("SELECT * 
								// 			FROM  `tblusers` WHERE TYPE != 'Customer'");
				  		$mydb->setQuery("SELECT * FROM  `tblusers`");
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
				  		echo '<tr>';
				  		// echo '<td width="5%" align="center"></td>';
				  		echo '<td>' . $result->USERID.'</a></td>';
				  		echo '<td>' . $result->FULLNAME.'</a></td>';
				  		echo '<td>'. $result->USERNAME.'</td>';
				  		echo '<td>'. $result->ROLE.'</td>';
				  		If($result->USERID==$_SESSION['ADMIN_USERID'] || $result->ROLE=='MainAdministrator' || $result->ROLE=='Administrator') {
				  			$active = "Disabled";

				  		}else{
				  			$active = "";

				  		}

				  		echo '<td align="center" > <a title="Edit" href="index.php?view=edit&id='.$result->USERID.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
								<a title="Delete" href="controller.php?action=delete&id='.$result->USERID.'" class="btn btn-danger btn-xs" '.$active.'><span class="fa fa-trash-o fw-fa"></span> </a>
								</td>';
				  		echo '</tr>';
				  	} */
				  	?>
				  </tbody>
				</table>  
			</div> 

<script type="text/javascript">
$(document).ready(function () {

    var dataTable;

    function load_data() {
        dataTable = $('#users-list').DataTable({
            "processing": false,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?php echo web_root?>/admin/user/ajax.php",
                type: "POST",
            },
            "columnDefs": [
                {
                    "targets": [4],
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