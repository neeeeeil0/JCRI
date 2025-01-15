<?php
header('Content-Type: application/json');

// Assuming a database connection is already established
if (isset($_GET['jobID'])) {
    $jobID = intval($_GET['jobID']); // Sanitize the jobID input

    // Updated SQL query
    $sql = "SELECT * FROM `tblcompany` c, `tbljob` j 
            WHERE c.`COMPANYID` = j.`COMPANYID` 
            AND JOBID LIKE '%" . $jobID . "%' 
            ORDER BY DATEPOSTED DESC";

    // Log the query for debugging purposes
    error_log("SQL Query: " . $sql);

    $mydb->setQuery($sql);
    $result = $mydb->loadResultList();

    if ($result && count($result) > 0) {
        // Assuming only one record is returned for a specific JOBID
        $data = $result[0]; // Get the first record

        // Log the fetched data for debugging purposes
        error_log("Fetched Data: " . print_r($data, true));

        // Encode the data as JSON with special characters escaped
        echo json_encode([
            'OCCUPATIONTITLE' => htmlspecialchars($data['OCCUPATIONTITLE']),
            'COMPANYNAME' => htmlspecialchars($data['COMPANYNAME']),
            'JOBDESCRIPTION' => nl2br(htmlspecialchars($data['JOBDESCRIPTION'])),
            'QUALIFICATION_WORKEXPERIENCE' => nl2br(htmlspecialchars($data['QUALIFICATION_WORKEXPERIENCE'])),
            'DATEPOSTED' => $data['DATEPOSTED']
        ]);
    } else {
        // Log error if no data is found
        error_log("No details found for JOBID: " . $jobID);

        echo json_encode(['error' => 'No details found']);
    }
} else {
    // Log error if no jobID is provided
    error_log("Invalid request: jobID not set.");

    echo json_encode(['error' => 'Invalid request']);
}
?>
