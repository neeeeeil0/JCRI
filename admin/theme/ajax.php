<?php
require_once ("../../include/initialize.php");

$mydb = new Database(); // Replace with your actual database connection class

// Count pending applications
$sqlApplicants = "SELECT count(*) as 'APPL' FROM `tbljobregistration` WHERE `PENDINGAPPLICATION`=1";
$mydb->setQuery($sqlApplicants);
$pending = $mydb->loadSingleResult();
$applicantsCount = $pending->APPL;

// Count unread messages
$sqlInbox = "SELECT count(*) as 'INBOX' FROM `tblinbox` WHERE `VIEW`=1"; // Adjust condition as needed
$mydb->setQuery($sqlInbox);
$inbox = $mydb->loadSingleResult();
$inboxCount = $inbox->INBOX;

// Return counts as JSON
echo json_encode([
    "applicants" => $applicantsCount,
    "inbox" => $inboxCount
]);
?>
