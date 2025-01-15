<style>
	#content {
		font-family: Arial, sans-serif;
		display: flex;
		flex-direction: column;
		align-items: center;
		min-height: 70vh; 
	}
	.search-container {
		margin: 20px 0;
		width: 100%;
		max-width: 800px;
		display: flex;
		gap: 10px;
	}

	.search-bar {
		flex: 2;
		padding: 10px;
		font-size: 16px;
		border: 1px solid #ccc;
		border-radius: 5px;
	}

	.dropdown-list {
		flex: 1;
		padding: 10px;
		font-size: 16px;
		border: 1px solid #ccc;
		border-radius: 5px;
	}

	.find-btn {
		padding: 10px 20px;
		font-size: 16px;
		background-color: #007BFF;
		color: white;
		border: none;
		border-radius: 5px;
		cursor: pointer;
	}

	.find-btn:hover {
		background-color: #0056b3;
	}

	.results-container {
		display: flex;
		flex-direction: column;
		gap: 20px;
		width: 100%;
		max-width: 1200px;
		max-height: 50vh;
		overflow-y: auto;
	}

	@media (min-width: 768px) {
		.results-container {
			flex-direction: row;
			overflow-y: hidden;
		}

		.results-list {
			flex: 1;
			border: 1px solid #ccc;
			border-radius: 5px;
			padding: 10px;
			overflow-y: auto;
			max-height: 70vh;
			max-width: 500px;
		}

		.result-details {
			flex: 2;
			border: 1px solid #ccc;
			border-radius: 5px;
			padding: 10px;
			overflow-y: auto;
			max-height: 70vh;
			max-width: 600px;
		}
	}

	.results-list table {
		width: 100%;
		border-collapse: collapse;
	}

	.results-list th, .results-list td {
		text-align: left;
		padding: 10px;
		border-bottom: 1px solid #eee;
		cursor: pointer;
		transition: background-color 0.3s;
	}
	.table-filter {
		background-color: #fff;
		border-bottom: 1px solid #eee;
	}
	.table-filter tbody tr:hover {
		cursor: pointer;
		background-color: #eee;
	}
	.table-filter tbody tr td {
		padding: 10px;
		vertical-align: middle;
		border-top-color: #eee;
	}
	.table-filter tbody tr.selected td {
		background-color: #eee;
	}
	.table-filter tr td:first-child {
		width: 38px;
	}
	.table-filter tr td:nth-child(2) {
		width: 35px;
	}
	
	.table-filter .star {
		color: #ccc;
		text-align: center;
		display: block;
	}
	.table-filter .star.star-checked {
		color: #F0AD4E;
	}
	.table-filter .star:hover {
		color: #ccc;
	}
	.table-filter .star.star-checked:hover {
		color: #F0AD4E;
	}
	.table-filter .media-photo {
		width: 35px;
	}
	.table-filter .media-body {
		display: block;
		/* Had to use this style to force the div to expand (wasn't necessary with my bootstrap version 3.3.6) */
	}
	.table-filter .media-meta {
		font-size: 11px;
		color: #999;
	}
	.table-filter .media .title {
		color: #2BBCDE;
		font-size: 14px;
		font-weight: bold;
		line-height: normal;
		margin: 0;
	}
	.table-filter .media .title span {
		font-size: .8em;
		margin-right: 20px;
	}
	.table-filter .media .title span.pagado {
		color: #5cb85c;
	}
	.table-filter .media .title span.pendiente {
		color: #f0ad4e;
	}
	.table-filter .media .title span.cancelado {
		color: #d9534f;
	}
	.table-filter .media .summary {
		font-size: 14px;
	}

	.results-list td:hover {
		background-color: #f9f9f9;
	}

	.result-details {
		background-color: #fdfdfd;
	}
	.results-list tr.selected {
		background-color: #f0f8ff; /* Light blue */
		transition: background-color 0.3s ease;
	}

</style>

<form action="index.php?q=result&searchfor=advancesearch" method="POST"> 
 <section id="content">
		<div class="search-container">
			<input type="text" class="search-bar" placeholder="Search...">
			<select class="dropdown-list">
				<option value="">Company</option>
				<?php
					$sql = "SELECT * FROM tblcompany";
					$mydb->setQuery($sql);
					$res = $mydb->loadResultList();
					foreach ($res as $row) { 
						echo '<option>'.$row->COMPANYNAME.'</option>';
					}
				?>
			</select>
			<select class="dropdown-list">
				<option value="">Classification</option>
				<?php
					$sql = "SELECT * FROM `tblcategory`";
					$mydb->setQuery($sql);
					$res = $mydb->loadResultList();
					foreach ($res as $row) { 
						echo '<option>'.$row->CATEGORY.'</option>';
					}
				?>
			</select>
			<button class="find-btn">Find</button>
		</div>

		<div class="container content">

		<div class="results-container">
			<div class="results-list">
				<table class="table table-filter">
					<tbody>
					<?php
						$search = isset($_POST['SEARCH']) ? $_POST['SEARCH'] : '';
						$company = isset($_POST['COMPANY']) ? $_POST['COMPANY'] : '';
						$category = isset($_POST['CATEGORY']) ? $_POST['CATEGORY'] : '';

						$sql = "SELECT * FROM `tbljob` j, `tblcompany` c 
								WHERE j.`COMPANYID`=c.`COMPANYID` 
								AND COMPANYNAME LIKE '%{$company}%' 
								AND CATEGORY LIKE '%{$category}%' 
								AND (`OCCUPATIONTITLE` LIKE '%{$search}%' 
								OR `JOBDESCRIPTION` LIKE '%{$search}%' 
								OR `QUALIFICATION_WORKEXPERIENCE` LIKE '%{$search}%')";
						$mydb->setQuery($sql);
						$cur = $mydb->executeQuery();
						$maxrow = $mydb->num_rows($cur);
						if ($maxrow > 0) {
							$res = $mydb->loadResultList();
							foreach ($res as $row) { 
					?>
						<tr data-id="<?php echo $row->JOBID; ?>">  
							<td> 
								<div class="media">
									<a href="#" class="pull-left">
										<span class="fa fa-building-o"></span>
									</a>
									<div class="media-body">
										<span class="media-meta pull-right"><?php echo $row->OCCUPATIONTITLE; ?></span>
										<h4 class="title">
											<a href="index.php?q=viewjob&search=<?php echo $row->JOBID ?>">
												<?php echo $row->OCCUPATIONTITLE; ?> 
											</a>
											<span class="pull-right pagado">(Company <?php echo $row->COMPANYNAME ?>)</span>
										</h4>
										<p class="summary"><?php echo $row->JOBDESCRIPTION; ?></p>
									</div>
								</div> 
							</td>
						</tr>
					<?php } } else {
						echo '<tr><td>No result found!.....</td></tr>';
					} ?>
					</tbody>
				</table>
			</div>

			<div class="result-details">
				<div id="details-text">Click on a row to view details.</div>
			</div>
		</div>

	</div>
 </section>
 </form>
 
 <script>
	document.addEventListener('DOMContentLoaded', () => {
		const resultsList = document.querySelectorAll('.results-list tr');
		const detailsText = document.getElementById('details-text');

		// Highlight and update details on row click
		resultsList.forEach(item => {
			item.addEventListener('click', () => {
				const jobID = item.getAttribute('data-id');
				
				if (jobID) {
					console.log(jobID);
					// Remove highlight from all rows
					resultsList.forEach(row => row.classList.remove('selected'));

					// Highlight the selected row
					item.classList.add('selected');

					// Animate the update of the details section
					detailsText.style.opacity = 0; // Fade out
					setTimeout(() => {
						detailsText.textContent = jobID; // Update text
						detailsText.style.opacity = 1; // Fade in
					}, 200); // Match the fade-out duration
				}
			});
		});

		// Set default details to the first result
		const defaultjobID = resultsList[0]?.getAttribute('data-id');
		if (defaultjobID) {
			detailsText.textContent = defaultjobID;
			resultsList[0].classList.add('selected'); // Highlight the first row by default
		}
		
		
	});


</script>