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
        border: 1px solid #ccc;
        border-radius: 5px; /* Slight curve */
        padding: 5px; /* Adding slight padding */
    }

    .searchbar {
        flex: 2;
        padding: 10px;
        font-size: 16px;
        border: none; /* Remove individual border */
        border-radius: 5px; /* Slight curve for the search bar */
    }

    .find-btn {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 8px; /* More curve for the button */
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
		color: #7f8c8d;
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
	.result-title h4 a {
    text-transform: uppercase; 
    text-decoration: none;
    font-weight: bold;
	}

        .result-title h5 {
            color: #7f8c8d;
            margin: 5px 0;
        }

        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            text-align: center;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        /* Divider */
        .divider {
            border: 0;
            height: 1px;
            background:rgb(27, 41, 44);
            margin: 20px 0;
        }

        /* Detail Sections */
        .result-detail {
            margin: 10px 0;
        }

        .section-title {
            font-weight: bold;
            color: #34495e;
            margin-bottom: 10px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        ul li {
            margin: 5px 0;
            line-height: 1.6;
        }

        .no-style {
            list-style: none;
            padding-left: 0;
        }

        .icon {
            margin-right: 8px;
            color: #16a085;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .btn {
                width: 100%;
                text-align: center;
            }
        }

</style>

<section id="content">
    <div class="search-container">
        <input type="text" class="searchbar" placeholder="Search a keyword..." name="find" id="search-bar" value="<?php echo isset($_GET['find']) ? htmlspecialchars($_GET['find']) : ''; ?>">
        <button class="find-btn" type="button" id="find-btn">Find</button>
    </div>

    <div class="container content">
        <div class="results-container">
            <div class="results-list">
                <table class="table table-filter" id="job-results-table">
                    <tbody>
                        <!-- Job List results will be displayed here -->
                    </tbody>
                </table>
            </div>

            <div class="result-details">
                <div id="details-text">
					 <!-- Job details results here -->
				</div>
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
			//console.log("Fetching job details for job ID:", jobId);

			fetch('get_job.php', {
				method: 'POST', // POST method
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded', // Setting the content type
				},
				body: `JOBID=${jobId}`, // Sending JOBID as part of the request body
			})
			.then(response => response.json())
			.then(data => {
				//console.log("Job Details Data:", data);

				if (data.error) {
					resultDetailsDiv.innerHTML = `<p>${data.error}</p>`;
				} else {
					resultDetailsDiv.innerHTML = `
						
		<div class="result-title">
        	<h4><a href="index.php?q=viewjob&search=${data.JOBID}">${data.OCCUPATIONTITLE}</a></h4>
        	<h5>${data.COMPANYNAME}</h5>
        	<h5>${data.COMPANYADDRESS}</h5>
        	<a href="index.php?q=apply&job=${data.JOBID}" class="btn">Apply Now!</a>
    	</div>
    	
		<hr class="divider">
    	<div class="result-detail">
			<p class="section-title">Job Details:</p>
			<ul>
				<li><i class="icon"></i> Job Setting: ${data.JOBSETTING}</li>
				<li><i class="icon"></i> Salary: ₱ ${Number(data.SALARIES).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</li>
				<li><i class="icon"></i> Preferred Sex: ${data.PREFEREDSEX}</li>
			</ul>
    	</div>
    	<hr class="divider">

		<div class="result-detail">
			<p class="section-title">Qualification/Work Experience:</p>
			<ul class="no-style">
				<li>${data.QUALIFICATION_WORKEXPERIENCE}</li>
			</ul>
		</div>
		<hr class="divider">
		<div class="result-detail">
			<p class="section-title">Job Description:</p>
			<ul class="no-style">
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
				//console.log("Search Results Data:", data);

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



