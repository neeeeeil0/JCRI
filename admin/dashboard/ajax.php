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

// Count accepted applicants
$sqlAcceptedApplicants = "SELECT count(*) as 'ACCEPTED' FROM `tblacceptedapplicants`"; // Adjust condition as needed
$mydb->setQuery($sqlAcceptedApplicants);
$acceptedApplicants = $mydb->loadSingleResult();
$acceptedCount = $acceptedApplicants->ACCEPTED;

// Return counts as JSON
echo json_encode([
    "company" => $companyCount,
    "category" => $categoryCount,
    "vacancy" => $vacancyCount,
    "applicant" => $applicantsCount,
    "hired" => $acceptedCount
]);
?>
