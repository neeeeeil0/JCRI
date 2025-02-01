<?php
require_once ("../../include/initialize.php");

$mydb = new Database(); // Replace with your actual database connection class

// Count company
$sqlCompany = "SELECT count(*) as 'COMPANY' FROM `tblcompany`";
$mydb->setQuery($sqlCompany);
$company = $mydb->loadSingleResult();
$companyCount = $company->COMPANY;

// Count classifications/category
$sqlCategory = "SELECT count(*) as 'CATEGORY' FROM `tblcategory`";
$mydb->setQuery($sqlCategory);
$category = $mydb->loadSingleResult();
$categoryCount = $category->CATEGORY;

// Count Vacancy
$sqlVacancy = "SELECT count(*) as 'VACANCY' FROM `tbljob`";
$mydb->setQuery($sqlVacancy);
$vacancy= $mydb->loadSingleResult();
$vacancyCount = $vacancy->VACANCY;

// Count applicants
$sqlApplicants = "SELECT count(*) as 'APPL' FROM `tbljobregistration`";
$mydb->setQuery($sqlApplicants);
$appl = $mydb->loadSingleResult();
$applicantsCount = $appl->APPL;

// Count messages inbox
$sqlInbox = "SELECT count(*) as 'INBOX' FROM `tblinbox`"; // Adjust condition as needed
$mydb->setQuery($sqlInbox);
$inbox = $mydb->loadSingleResult();
$inboxCount = $inbox->INBOX;

// Return counts as JSON
echo json_encode([
    "company" => $companyCount,
    "category" => $categoryCount,
    "vacancy" => $vacancyCount,
    "applicant" => $applicantsCount,
    "inbox" => $inboxCount
]);
?>
