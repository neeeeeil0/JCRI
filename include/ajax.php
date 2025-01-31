<?php
require_once ("../include/initialize.php");
$mydb = new Database();

$applicantID = $_SESSION['APPLICANTID']; 
$searchQuery = isset($_GET['query']) ? trim($_GET['query']) : '';
$fetchType = isset($_GET['fetchType']) ? $_GET['fetchType'] : 'messages'; // Default: Fetch messages

if ($fetchType === 'count') {
    // Fetch count of unread messages
    $sql = "SELECT COUNT(*) as 'COUNT' FROM `tblcompany` c, `tbljobregistration` j, `tblfeedback` f 
            WHERE c.`COMPANYID` = j.`COMPANYID` 
            AND j.`REGISTRATIONID` = f.`REGISTRATIONID`
            AND f.VIEW = 1
            AND j.`APPLICANTID` = '{$applicantID}'";

    $mydb->setQuery($sql);
    $showMsg = $mydb->loadSingleResult();
    $msgCount = isset($showMsg->COUNT) ? $showMsg->COUNT : 0;
    
    echo json_encode(["count" => $msgCount]); // Return JSON response
    exit;
}

// If fetching messages instead of count
$sql = "SELECT * FROM `tblcompany` c, `tbljobregistration` j, `tblfeedback` f 
        WHERE c.`COMPANYID` = j.`COMPANYID` 
        AND j.`REGISTRATIONID` = f.`REGISTRATIONID` 
        AND `PENDINGAPPLICATION` = 0 
        AND j.`APPLICANTID` = '{$applicantID}'";

if (!empty($searchQuery)) {
    $sql .= " AND (c.`COMPANYNAME` LIKE '%$searchQuery%' OR f.`FEEDBACK` LIKE '%$searchQuery%')";
}

$sql .= " ORDER BY f.`DATETIMESAVED` DESC";

$mydb->setQuery($sql);
$cur = $mydb->loadResultList();

if (empty($cur)) {
    echo '<tr><td colspan="4" class="text-center">No messages found.</td></tr>';
} else {
    foreach ($cur as $result) {
        $rowStyle = ($result->VIEW == 1) ? 'font-weight: bold;' : '';
        echo '<tr style="' . $rowStyle . '">';
        echo '<td class="mailbox-name"><a href="index.php?view=message&p=readmessage&id='.$result->FEEDBACKID.'">'.$result->COMPANYNAME.'</a></td>';
        echo '<td class="mailbox-subject">'.$result->FEEDBACK.'</td>'; 
        echo '<td class="mailbox-date">'.$result->DATETIMEAPPROVED.'</td>';
        echo '</tr>';
    }
}
?>
