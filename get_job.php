<?php
// Include your configuration file to get the database constants
include('include/config.php');
$mydb2 = new mysqli(server, user, pass, database_name);

if ($mydb2->connect_error) {
    die(json_encode(['error' => 'Database connection failed: ' . $mydb2->connect_error]));
}

// Check if the JOBID is provided in the POST request for fetching job details
if (isset($_POST['JOBID'])) {
    $jobId = intval($_POST['JOBID']); // Sanitize the JOBID to prevent SQL injection

    // Prepare the SQL query to fetch job details
    $sql = "SELECT * FROM tbljob j 
            INNER JOIN tblcompany c ON j.COMPANYID = c.COMPANYID 
            WHERE j.JOBID = ?";
    $stmt = $mydb2->prepare($sql);

    if ($stmt) {
        // Bind the JOBID parameter and execute the query
        $stmt->bind_param('i', $jobId);
        $stmt->execute();
        $result = $stmt->get_result();

        // If the job is found, return the details as JSON
        if ($result->num_rows > 0) {
            $jobDetails = $result->fetch_assoc();
            echo json_encode($jobDetails);
        } else {
            echo json_encode(['error' => 'Job not found.']);
        }

        $stmt->close(); // Close the prepared statement
    } else {
        echo json_encode(['error' => 'Failed to prepare SQL statement.']);
    }
} 
// Check if the search query is provided in the GET request
else if (isset($_GET['find'])) {
    $searchQuery = $_GET['find'];

    // Sanitize the search query to prevent SQL injection
    $searchQuery = $mydb2->real_escape_string($searchQuery);

    // If search term is empty, fetch all jobs
    if (empty($searchQuery)) {
        $sql = "SELECT * FROM tbljob j INNER JOIN tblcompany c ON j.COMPANYID = c.COMPANYID ORDER BY j.JOBID DESC;";
    } else {
        // If search term is provided, filter by OCCUPATIONTITLE, COMPANYNAME, and COMPANYADDRESS
        $sql = "SELECT * 
                FROM tbljob j 
                INNER JOIN tblcompany c ON j.COMPANYID = c.COMPANYID
                WHERE j.OCCUPATIONTITLE LIKE '%$searchQuery%' 
                OR c.COMPANYNAME LIKE '%$searchQuery%' 
                OR c.COMPANYADDRESS LIKE '%$searchQuery%' 
                OR j.QUALIFICATION_WORKEXPERIENCE LIKE '%$searchQuery%'
                ORDER BY 
                CASE 
                    WHEN j.OCCUPATIONTITLE LIKE '$searchQuery%' THEN 1  -- Prefix match
                    WHEN j.OCCUPATIONTITLE LIKE '%$searchQuery%' THEN 2  -- Anywhere match
                    ELSE 3 
                END,
                j.OCCUPATIONTITLE ASC;";
    }

    $result = $mydb2->query($sql);

    if ($result->num_rows > 0) {
        $jobs = [];
        while ($row = $result->fetch_assoc()) {
            $jobs[] = $row;
        }
        echo json_encode($jobs); // Return jobs as JSON
    } else {
        echo json_encode(['error' => 'No jobs found.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request.']);
}

// Close the database connection
$mydb2->close();
?>
