<?php 
	  if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     } 
?>
	<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">List of Vacancies  <a href="index.php?view=add" class="btn btn-primary btn-xs  ">  <i class="fa fa-plus-circle fw-fa"></i> Add Job Vacancy</a>  </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  	
			     <div class="table-responsive">					
				<table id="job-list" class="table table-striped table-bordered table-hover"  style="font-size:14px;width:100%" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		<!-- <th>No.</th> -->
						<th width="20%">Job Title</th>
						<th width="20%">
							<select name="company" id="company" style="border:none;width:100%;">
								<option value="">Company</option>
								<?php 
									$sql ="Select * From tblcompany order by COMPANYNAME";
									$mydb->setQuery($sql);
									$res  = $mydb->loadResultList();
									foreach ($res as $row) {
									# code...
									echo '<option value='.$row->COMPANYID.'>'.$row->COMPANYNAME.'</option>';
									}
								?>
							</select>
						</th> 
				  		<!-- <th>Require no. of Employees</th> --> 
				  		<!-- <th>Duration of Employment</th> 
				  		<th>Qualification/Work experience</th> 
				  		<th>Job Description</th> 
				  		<th>Prefered Sex</th> 
				  		<th>Sector of Vacancy</th> -->
						<th width="10%">
							<select name="jobtype" id="jobtype" style="border:none;width:100%;">
								<option value="">Job Type</option>
								<option value="On-Site">On-Site</option>
								<option value="Work From Home">Work From Home</option>
								<option value="Hybrid">Hybrid</option>
							</select>
						</th>
						<th width="10%">Publisher</th>
				  		<th width="10%">Job Status</th>
				  		<th width="5%" align="center">Action</th>
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php 
				  	 /*/ `COMPANYID`, `OCCUPATIONTITLE`, `REQ_NO_EMPLOYEES`, `SALARIES`, `DURATION_EMPLOYEMENT`, `QUALIFICATION_WORKEXPERIENCE`, `JOBDESCRIPTION`, `PREFEREDSEX`, `SECTOR_VACANCY`, `JOBSTATUS`
				  		$mydb->setQuery("SELECT j.*, c.COMPANYNAME, u.FULLNAME
												FROM tbljob j
												LEFT JOIN tblcompany c ON j.COMPANYID = c.COMPANYID
												LEFT JOIN tblusers u ON j.PUBLISHERID = u.USERID
												ORDER BY j.OCCUPATIONTITLE;");
				  		$cur = $mydb->loadResultList(); 
						foreach ($cur as $result) {
				  		echo '<tr>';
				  		// echo '<td width="5%" align="center"></td>';
				  		// echo '<td>
				  		//      <input type="checkbox" name="selector[]" id="selector[]" value="'.$result->CATEGORYID. '"/>
				  		// 		' . $result->CATEGORIES.'</a></td>';
				  			echo '<td>' . $result->COMPANYNAME.'</td>';
				  			echo '<td>' . $result->OCCUPATIONTITLE.'</td>';
				  			//echo '<td>' . $result->REQ_NO_EMPLOYEES.'</td>';
				  			echo '<td>' . $result->SALARIES.'</td>';
				  			//echo '<td>' . $result->DURATION_EMPLOYEMENT.'</td>';
				  			//echo '<td>' . $result->QUALIFICATION_WORKEXPERIENCE.'</td>';
				  			//echo '<td>' . $result->JOBDESCRIPTION.'</td>';
				  			//echo '<td>' . $result->PREFEREDSEX.'</td>';
				  			//echo '<td>' . $result->SECTOR_VACANCY.'</td>';
							echo '<td>' . $result->FULLNAME.'</td>';
				  			echo '<td>' . $result->JOBSTATUS.'</td>';
				  			echo '<td align="center"><a title="Edit" href="index.php?view=edit&id='.$result->JOBID.'" class="btn btn-primary btn-xs">  <span class="fa fa-edit fw-fa"></a>
				  		     <a title="Delete" href="controller.php?action=delete&id='.$result->JOBID.'" class="btn btn-danger btn-xs  ">  <span class="fa  fa-trash-o fw-fa "></a></td>';
				  		// echo '<td></td>';
				  			echo '</tr>';
				  	} */
				  	?>
				  </tbody>
					
				</table>
						<div class="btn-group">
				 <!--  <a href="index.php?view=add" class="btn btn-default">New</a> -->
					<?php
					if($_SESSION['ADMIN_ROLE']=='Administrator'){
					// echo '<button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button'
					; }?>
				</div>
			
			
				</form>
	
 <div class="table-responsive">

 <script type="text/javascript">
$(document).ready(function () {
    var dataTable;

    function load_data(is_company = '', job_type = '') {
        dataTable = $('#job-list').DataTable({
            "processing": false,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "ajax.php",
                type: "POST",
                data: {
                    is_company: is_company, // Pass the selected company
                    job_type: job_type     // Pass the selected job type
                }
            },
            "columnDefs": [
                {
                    "targets": [1, 2, 5],
                    "orderable": false,
                },
            ],
            "destroy": true // Ensure the table can be refreshed without errors
        });
    }

    // Initialize DataTable
    load_data();

    // Handle company dropdown changes
    $('#company').on('change', function () {
        var company = $('#company').val();
        var job_type = $('#jobtype').val(); // Get the current job type filter
        dataTable.destroy(); // Destroy existing table instance
        load_data(company, job_type); // Reload with new filters
    });

    // Handle job type dropdown changes
    $('#jobtype').on('change', function () {
        var company = $('#company').val(); // Get the current company filter
        var job_type = $('#jobtype').val(); // Get the selected job type
        dataTable.destroy(); // Destroy existing table instance
        load_data(company, job_type); // Reload with new filters
    });

    // Periodically reload the table without resetting paging
    setInterval(function () {
        dataTable.ajax.reload(null, false); // Reload the table
    }, 1000);
});
</script>
