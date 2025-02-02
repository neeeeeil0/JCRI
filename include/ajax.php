<?php
require_once ("../include/initialize.php");
$mydb = new Database();

$applicantID = $_SESSION['APPLICANTID']; 
$searchQuery = isset($_GET['query']) ? trim($_GET['query']) : '';
$fetchType = isset($_GET['fetchType']) ? $_GET['fetchType'] : 'messages'; // Default: Fetch messages

if ($fetchType === 'notifications') {
    // Fetch latest notifications
    $sql = "SELECT n.*, j.OCCUPATIONTITLE, j.JOBDESCRIPTION, j.DATEPOSTED, c.COMPANYNAME
            FROM tblnotification n
            JOIN tbljob j ON n.JOBID = j.JOBID
            JOIN tblcompany c ON j.COMPANYID = c.COMPANYID
            WHERE n.APPLICANTID = $applicantID
            ORDER BY n.DATECREATED DESC LIMIT 10";

    $mydb->setQuery($sql);
    $cur = $mydb->loadResultList();

    $notifications = [];
    foreach ($cur as $result) {
        $notifications[] = [
            "JOBID" => $result->JOBID,
            "NOTIFICATIONID" => $result->NOTIFICATIONID,
            "OCCUPATIONTITLE" => $result->OCCUPATIONTITLE,
            "JOBDESCRIPTION" => $result->JOBDESCRIPTION,
            "DATECREATED" => $result->DATECREATED,
            "ISVIEWED" => $result->ISVIEWED
        ];
    }

    echo json_encode(["notifications" => $notifications]);
    exit;
}

if ($fetchType === 'count') {
    // Fetch unread message count
    $sqlMsg = "SELECT COUNT(*) as 'COUNT' FROM `tblcompany` c, `tbljobregistration` j, `tblfeedback` f 
               WHERE c.`COMPANYID` = j.`COMPANYID` 
               AND j.`REGISTRATIONID` = f.`REGISTRATIONID`
               AND f.VIEW = 1
               AND j.`APPLICANTID` = '{$applicantID}'";

    $mydb->setQuery($sqlMsg);
    $showMsg = $mydb->loadSingleResult();
    $msgCount = isset($showMsg->COUNT) ? $showMsg->COUNT : 0;

    // Fetch unread notification count
    $sqlNotif = "SELECT COUNT(*) as 'COUNTNOTIF' FROM `tblnotification` 
                 WHERE APPLICANTID = '{$applicantID}' AND ISVIEWED = 0";

    $mydb->setQuery($sqlNotif);
    $showNotif = $mydb->loadSingleResult();
    $notifCount = isset($showNotif->COUNTNOTIF) ? $showNotif->COUNTNOTIF : 0;

    // Return JSON response for both counts
    echo json_encode(["messages" => $msgCount, "notifications" => $notifCount]);
    exit;
}

$limit = 10; // Number of messages per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;
$searchQuery = isset($_GET['query']) ? $_GET['query'] : "";

// Base SQL query
$sql = "SELECT * FROM `tblcompany` c, `tbljobregistration` j, `tblfeedback` f 
        WHERE c.`COMPANYID` = j.`COMPANYID` 
        AND j.`REGISTRATIONID` = f.`REGISTRATIONID` 
        AND `PENDINGAPPLICATION` = 0 
        AND j.`APPLICANTID` = '$applicantID'";

// If search query is provided
if (!empty($searchQuery)) {
    $sql .= " AND (c.COMPANYNAME LIKE '%$searchQuery%' OR f.FEEDBACK LIKE '%$searchQuery%')";
}

// Add ORDER and LIMIT
$sql .= " ORDER BY f.`DATETIMESAVED` DESC LIMIT $start, $limit";
$mydb->setQuery($sql);
$messages = $mydb->loadResultList();

// Get total message count for pagination
$totalQuery = "SELECT COUNT(*) as total FROM `tblcompany` c, `tbljobregistration` j, `tblfeedback` f 
              WHERE c.`COMPANYID` = j.`COMPANYID` 
              AND j.`REGISTRATIONID` = f.`REGISTRATIONID` 
              AND `PENDINGAPPLICATION` = 0 
              AND j.`APPLICANTID` = '$applicantID'";
if (!empty($searchQuery)) {
    $totalQuery .= " AND (c.COMPANYNAME LIKE '%$searchQuery%' OR f.FEEDBACK LIKE '%$searchQuery%')";
}
$mydb->setQuery($totalQuery);
$totalResult = $mydb->loadSingleResult();
$totalMessages = isset($totalResult->total) ? $totalResult->total : 0;
$totalPages = ceil($totalMessages / $limit);

// Generate table rows
$output = "";
if (!empty($messages)) {
    foreach ($messages as $result) {
        $rowStyle = ($result->VIEW == 1) ? 'font-weight: bold;' : '';
        $output .= '<tr style="' . $rowStyle . '">';
        $output .= '<td class="mailbox-name"><a href="index.php?view=message&p=readmessage&id='.$result->FEEDBACKID.'">'.$result->COMPANYNAME.'</a></td>';
        $output .= '<td class="mailbox-subject">'.$result->FEEDBACK.'</td>';
        $output .= '<td class="mailbox-date">'.date("M. j, Y, g:ia", strtotime($result->DATETIMESAVED)).'</td>';
        $output .= '</tr>';
    }
} else {
    $output .= '<tr><td colspan="4" class="text-center">No messages available.</td></tr>';
}


// Pagination buttons (only show if there's more than one page)
$pagination = '';
if ($totalPages > 1) {
    $pagination .= '<div class="pull-right">';
    $pagination .= 'Showing ' . ($start + 1) . ' to ' . min(($start + $limit), $totalMessages) . ' of ' . $totalMessages .' messages ';
    $pagination .= '<div class="btn-group">';

    // Previous button (only show if not on first page)
    if ($page > 1) {
        $pagination .= '<button type="button" class="btn btn-default btn-sm prev-page" data-page="' . ($page - 1) . '">
                            <i class="fa fa-chevron-left"></i>
                        </button>';
    }

    // Next button (only show if not on last page)
    if ($page < $totalPages) {
        $pagination .= '<button type="button" class="btn btn-default btn-sm next-page" data-page="' . ($page + 1) . '">
                            <i class="fa fa-chevron-right"></i>
                        </button>';
    }

    $pagination .= '</div></div>';
}

echo json_encode(["messages" => $output, "pagination" => $pagination]);
?>
