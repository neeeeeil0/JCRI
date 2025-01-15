<?php
//include('dbconnection.php'); // Include your database connection file
$mydb = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jobID = isset($_POST['jobID']) ? $_POST['jobID'] : '';

    if ($jobID) {
        // Query to fetch job details
        $sql = "SELECT * FROM `tblcompany` c, `tbljob` j 
                WHERE c.`COMPANYID` = j.`COMPANYID` 
                AND JOBID LIKE '%" . $jobID . "%' 
                ORDER BY DATEPOSTED DESC";
        $mydb->setQuery($sql);
        $cur = $mydb->loadResultList();

        // Check if results exist
        if (!empty($cur)) {
            $response = [];
            foreach ($cur as $result) {
                $response[] = [
                    'title' => $result->OCCUPATIONTITLE,
                    'company' => $result->COMPANYNAME,
                    'description' => $result->JOBDESCRIPTION,
                    'requirements' => $result->QUALIFICATION_WORKEXPERIENCE,
                    'salary' => $result->SALARY,
                    'datePosted' => $result->DATEPOSTED
                ];
            }
            echo json_encode($response);
        } else {
            echo json_encode(['error' => 'No job details found.']);
        }
    } else {
        echo json_encode(['error' => 'Invalid job ID.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}

?>
