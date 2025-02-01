<?php
	 if(!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     }

?> 
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">List of Applicant's   </h1>
        </div>
    </div>
                
 
    <form class="wow fadeInDownaction" action="controller.php?action=delete" Method="POST">   		
        <table id="applicants-list" class="table table-striped table-bordered table-hover"  style="font-size:14px;width:100%;" cellspacing="0">
            <thead>
            <tr>
                <th>Application ID</th>
                <th>Applicant</th>
                <th>
                <select name="jobtitle" id="jobtitle" style="border:none;width:100%;">
                        <option value="">Job Title</option>
                        <?php 
                            $sql ="Select * From tbljob order by OCCUPATIONTITLE";
                            $mydb->setQuery($sql);
                            $res  = $mydb->loadResultList();
                            foreach ($res as $row) {
                              # code...
                              echo '<option value='.$row->JOBID.'>'.$row->OCCUPATIONTITLE.'</option>';
                            }
                          ?>
                    </select>
                </th>
                <th>
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
                <th>Applied Date</th>
                <th>Modified By:</th> 
                <th>
                    <select name="status" id="status" style="border:none;width:100%;">
                        <option value="">Status</option>
                        <option>Pending</option>
                        <option>For Review</option>
                        <option>For Initial Screening</option>
                        <option>For Interview</option>
                        <option>For Assessment</option>
                        <option>Hired</option>
				        <option>Rejected</option>
                    </select>
                </th>
                <th width="10%" >Action</th> 
            </tr>	
            </thead> 
            <tbody>
            <?php
            /* rows will be updated
                // $mydb->setQuery("SELECT * 
                        // 			FROM  `tblusers` WHERE TYPE != 'Customer'");
                $mydb->setQuery("SELECT * FROM `tblcompany` c  , `tbljobregistration` j, `tbljob` j2, `tblapplicants` a WHERE c.`COMPANYID`=j.`COMPANYID` AND  j.`JOBID`=j2.`JOBID` AND j.`APPLICANTID`=a.`APPLICANTID`");
                $cur = $mydb->loadResultList();

                foreach ($cur as $result) { 
                $rowClass = ($result->PENDINGAPPLICATION == 1) ? 'style="font-weight: bold;"' : '';

                echo '<tr ' . $rowClass . '>';
                // echo '<td width="5%" align="center"></td>';
                echo '<td>'. $result->REGISTRATIONID.'</td>';
                echo '<td>'. $result->APPLICANT.'</td>';
                echo '<td>' . $result->OCCUPATIONTITLE.'</a></td>';
                echo '<td>' . $result->COMPANYNAME.'</a></td>'; 
                echo '<td>'. $result->REGISTRATIONDATE.'</td>';
                echo '<td>'. $result->REMARKS.'</td>';  
                echo '<td align="center" >    
                        <a title="View" href="index.php?view=view&id='.$result->REGISTRATIONID.'"  class="btn btn-info btn-xs  ">
                        <span class="fa fa-info fw-fa"></span> View</a> 
                        <a title="Remove" href="controller.php?action=delete&id='.$result->REGISTRATIONID.'"  class="btn btn-danger btn-xs  ">
                        <span class="fa fa-trash-o fw-fa"></span> Remove</a> 
                        </td>';
                echo '</tr>';
            } */
            ?>
            </tbody>
            
        </table> 
    </form>

<script type="text/javascript">
$(document).ready(function () {

    var dataTable;

    function load_data(is_company = '', job_title = '', job_status = '') {
        dataTable = $('#applicants-list').DataTable({
            "processing": false,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "ajax.php",
                type: "POST",
                data: {
                    is_company: is_company,
                    job_title: job_title,
                    job_status: job_status // Pass the selected job title
                }
            },
            "columnDefs": [
                {
                    "targets": [2,3,6,7],
                    "orderable": false,
                },
            ],
            "createdRow": function (row, data, dataIndex) {
                if (data['PENDINGAPPLICATION'] === true || data['PENDINGAPPLICATION'] == 1) { // Check for pending applications
                    $(row).css("font-weight", "bold"); // Apply bold styling
                }
            },
            "destroy": true // Ensure the table can be refreshed without errors
        });
    }

    // Initialize DataTable
    load_data();

    // Handle dropdown changes
    $('#jobtitle, #company, #status').on('change', function () {
        var job_title = $('#jobtitle').val();
        var company = $('#company').val();
        var job_status = $('#status').val();
        dataTable.destroy(); // Destroy existing table instance
        load_data(company, job_title, job_status); // Reload with new filters
    });

    setInterval(function () {
        dataTable.ajax.reload(null, false); // Reload the table without resetting the paging
    }, 1000);
});
</script>


 