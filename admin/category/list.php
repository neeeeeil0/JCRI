<?php 
	  if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     } 
?>
	<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">List of Classification  <a href="index.php?view=add" class="btn btn-primary btn-xs  ">  <i class="fa fa-plus-circle fw-fa"></i> Add Classification</a>  </h1>
		</div>
	</div>

	<form action="controller.php?action=delete" Method="POST">  	
		<div class="table-responsive">					
			<table id="category-list" class="table table-striped table-bordered table-hover"  style="font-size:14px" cellspacing="0">
			
			<thead>
				<tr>
					<!-- <th>No.</th> -->
					<th>Classification Name</th> 
					<th width="10%" align="center">Action</th>
				</tr>	
			</thead> 
			<tbody>
				<?php /*
					$mydb->setQuery("SELECT * FROM `tblcategory`");
					$cur = $mydb->loadResultList();

					foreach ($cur as $result) {
					echo '<tr>';
					// echo '<td width="5%" align="center"></td>';
					// echo '<td>
					//      <input type="checkbox" name="selector[]" id="selector[]" value="'.$result->CATEGORYID. '"/>
					// 		' . $result->CATEGORIES.'</a></td>';
						echo '<td>' . $result->CATEGORY.'</td>';
					echo '<td align="center"><a title="Edit" href="index.php?view=edit&id='.$result->CATEGORYID.'" class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></a>
						<a title="Delete" href="controller.php?action=delete&id='.$result->CATEGORYID.'" class="btn btn-danger btn-xs  ">  <span class="fa  fa-trash-o fw-fa "></a></td>';
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
			
		</div>
	</form>
	
<script type="text/javascript">
$(document).ready(function () {

    var dataTable;

    function load_data() {
        dataTable = $('#category-list').DataTable({
            "processing": false,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "ajax.php",
                type: "POST",
            },
            "columnDefs": [
                {
                    "targets": [1],
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


						 