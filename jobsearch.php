<style>
	#content {
		font-family: Arial, sans-serif;
		display: flex;
		flex-direction: column;
		align-items: center;
		
	}
	.search-container {
		margin: 20px 0;
		width: 80%;
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
		max-height: 90vh;
		overflow-y: auto;
		margin-bottom: 50px;
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
	@media (width: 375px) {
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
			max-width: 400px;
		}

		.result-details {
			display:none;
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
	.table-filter .media .pagado {
		color: #5cb85c;
		font-size: 14px;
		font-weight: bold;
		line-height: normal;
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

	.selected-row {
        background-color: #f0f8ff; /* Light blue background */
    }

</style>

<section id="content">
    <div class="search-container">
        <input type="text" class="search-bar" placeholder="Search..." name="find" id="search-bar" value="<?php echo isset($_GET['find']) ? htmlspecialchars($_GET['find']) : ''; ?>">
        <button class="find-btn" type="button" id="find-btn">Find</button>
    </div>

    <div class="container content">
        <div class="results-container">
            <div class="results-list">
                <table class="table table-filter" id="job-results-table">
                    <tbody>
                        <!-- Job results will be displayed here -->
                    </tbody>
                </table>
            </div>

            <div class="result-details">
                <div id="details-text">Click on a row to view details.</div>
            </div>
        </div>
    </div>
</section>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		const rows = document.querySelectorAll('.results-list tr');
		const detailsDiv = document.getElementById('details-text');
		const resultDetailsDiv = document.querySelector('.result-details');
		const searchBar = document.getElementById('search-bar');
		const findButton = document.getElementById('find-btn');
		const jobResultsTable = document.getElementById('job-results-table');

		// Function to fetch job details
		function fetchJobDetails(jobId) {
			console.log("Fetching job details for job ID:", jobId);

			fetch('get_job.php', {
				method: 'POST', // POST method
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded', // Setting the content type
				},
				body: `JOBID=${jobId}`, // Sending JOBID as part of the request body
			})
			.then(response => response.json())
			.then(data => {
				console.log("Job Details Data:", data);

				if (data.error) {
					resultDetailsDiv.innerHTML = `<p>${data.error}</p>`;
				} else {
					resultDetailsDiv.innerHTML = `
						<div>
							<h4><a href="index.php?q=viewjob&search=${data.JOBID}">${data.OCCUPATIONTITLE}</a></h4>
							<h5>${data.COMPANYNAME}</h5>
							<h5>${data.COMPANYADDRESS}</h5>
							<a href="index.php?q=apply&job=${data.JOBID}" class="btn btn-main btn-next-tab">Apply Now!</a>
						</div>
						<div>
							<p>Job Details:</p>
							<ul>
								<li><i class="fp-ht-food"></i>Salary: ${data.SALARIES}</li>
								<li><i class="fa fa-sun-"></i>Duration of Employment: ${data.DURATION_EMPLOYEMENT}</li>
								<li><i class="fp-ht-tv"></i>Preferred Sex: ${data.PREFEREDSEX}</li>
							</ul>
						</div>
						<div>
							<p>Qualification/Work Experience:</p>
							<ul style="list-style: none;">
								<li>${data.QUALIFICATION_WORKEXPERIENCE}</li>
							</ul>
						</div>
						<div>
							<p>Job Description:</p>
							<ul style="list-style: none;">
								<li>${data.JOBDESCRIPTION}</li>
							</ul>
						</div>
					`;
				}
			})
			.catch(error => {
				resultDetailsDiv.innerHTML = `<p>Error fetching job details. Please try again later.</p>`;
				console.error('Error:', error);
			});
		}

		// Function to fetch search results based on the query
		function fetchSearchResults(query = '') {
			const url = `get_job.php?find=${encodeURIComponent(query)}`;

			fetch(url, {
				method: 'GET', // Use GET method to send data in the URL
				headers: {
					'Content-Type': 'application/json',
				}
			})
			.then(response => response.json())
			.then(data => {
				console.log("Search Results Data:", data);

				if (data.error) {
					jobResultsTable.querySelector('tbody').innerHTML = `<tr><td colspan="5">${data.error}</td></tr>`;
				} else {
					let rowsHtml = '';
					data.forEach(job => {
						rowsHtml += `
							<tr data-id="${job.JOBID}">  
								<td>
									<div class="media">
										<a href="#" class="pull-left">
											<span class="fa fa-building-o"></span>
										</a>
										<div class="media-body">
											<span class="media-meta pull-right">${job.COMPANYADDRESS}</span>
											<h2 class="title">
												<a href="index.php?q=viewjob&search=${job.JOBID}">
													${job.OCCUPATIONTITLE}
												</a>
											</h2>
											<p class="pagado">${job.COMPANYNAME}</p>
											<p class="summary">${job.JOBDESCRIPTION}</p>
										</div>
									</div> 
								</td>
							</tr>
						`;
					});
					jobResultsTable.querySelector('tbody').innerHTML = rowsHtml;

					// Add event listeners to rows for displaying job details
					const rows = document.querySelectorAll('.results-list tr');
					if (rows.length > 0) {
						const firstRow = rows[0];
						const firstJobId = firstRow.getAttribute('data-id');
						detailsDiv.textContent = `Selected Job ID: ${firstJobId}`;
						fetchJobDetails(firstJobId); // Fetch and display the first row's details by default
						firstRow.classList.add('selected-row');
					}

					rows.forEach(row => {
						row.addEventListener('click', function () {
							document.querySelectorAll('.selected-row').forEach(r => r.classList.remove('selected-row'));
							const jobId = this.getAttribute('data-id');
							detailsDiv.textContent = `Selected Job ID: ${jobId}`;
							this.classList.add('selected-row');
							fetchJobDetails(jobId);
						});
					});
				}
			})
			.catch(error => {
				console.error('Error:', error);
				jobResultsTable.querySelector('tbody').innerHTML = `<tr><td colspan="5">Error fetching results. Please try again later.</td></tr>`;
			});
		}

		// Fetch all results by default
		fetchSearchResults();

		// Event listener for search button click
		findButton.addEventListener('click', function () {
			const query = searchBar.value.trim();
			fetchSearchResults(query);
		});

		// Event listener for Enter key press in the search bar
		searchBar.addEventListener('keydown', function(event) {
			if (event.key === 'Enter') {
				event.preventDefault();  // Prevent the default form submit behavior
				const query = searchBar.value.trim();
				fetchSearchResults(query);  // Trigger search results
			}
		});
	});

</script>



