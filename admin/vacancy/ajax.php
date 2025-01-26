<?php
require_once ("../../include/initialize.php");
//ajax.php
$mydb = new Database(); // Replace with your actual database connection class

$column = array("j.OCCUPATIONTITLE", "c.COMPANYNAME", "j.JOBSETTING", "u.FULLNAME", "j.JOBSTATUS");

$query = "
    SELECT j.*, c.COMPANYNAME, u.FULLNAME
    FROM tbljob j
    JOIN tblcompany c ON j.COMPANYID = c.COMPANYID
    JOIN tblusers u ON j.PUBLISHERID = u.USERID
    WHERE 1 = 1
";

// Company filter
if (!empty($_POST["is_company"])) {
    $company_id = intval($_POST["is_company"]);
    $query .= " AND j.COMPANYID = $company_id";
}

// Job Setting filter
if (!empty($_POST["job_setting"])) {
    $job_setting = htmlspecialchars($_POST["job_setting"], ENT_QUOTES);
    $query .= " AND j.JOBSETTING = '$job_setting'";
}

// Search filter
if (!empty($_POST["search"]["value"])) {
    $search = htmlspecialchars($_POST["search"]["value"], ENT_QUOTES);
    $query .= " AND (
        j.OCCUPATIONTITLE LIKE '%$search%' OR
        c.COMPANYNAME LIKE '%$search%' OR
        j.JOBSETTING LIKE '%$search%' OR
        u.FULLNAME LIKE '%$search%' OR
        j.JOBSTATUS LIKE '%$search%'
    )";
}

// Ordering
if (!empty($_POST["order"])) {
    $query .= " ORDER BY " . $column[$_POST['order']['0']['column']] . " " . $_POST['order']['0']['dir'];
} else {
    $query .= " ORDER BY j.OCCUPATIONTITLE";
}

// Pagination
if ($_POST["length"] != -1) {
    $query .= " LIMIT " . intval($_POST['start']) . ", " . intval($_POST['length']);
}

$mydb->setQuery($query);
$cur = $mydb->loadResultList();

// Count filtered rows
$filteredCountQuery = "
    SELECT COUNT(*) as total 
    FROM tbljob j
    JOIN tblcompany c ON j.COMPANYID = c.COMPANYID
    JOIN tblusers u ON j.PUBLISHERID = u.USERID
    WHERE 1 = 1
";
//Fiter
if (!empty($_POST["is_company"])) {
    $filteredCountQuery .= " AND j.COMPANYID = $company_id";
}
if (!empty($_POST["job_setting"])) {
    $filteredCountQuery .= " AND j.JOBSETTING = '$job_setting'";
}
if (!empty($_POST["search"]["value"])) {
    $filteredCountQuery .= " AND (
        j.OCCUPATIONTITLE LIKE '%$search%' OR
        c.COMPANYNAME LIKE '%$search%' OR
        j.JOBSETTING LIKE '%$search%' OR
        u.FULLNAME LIKE '%$search%' OR
        j.JOBSTATUS LIKE '%$search%'
    )";
}
$mydb->setQuery($filteredCountQuery);
$filteredCount = $mydb->loadSingleResult()->total;

// Count total rows
$totalCountQuery = "
    SELECT COUNT(*) as total 
    FROM tbljob j
    JOIN tblcompany c ON j.COMPANYID = c.COMPANYID
    JOIN tblusers u ON j.PUBLISHERID = u.USERID
";
$mydb->setQuery($totalCountQuery);
$totalCount = $mydb->loadSingleResult()->total;

// Prepare DataTable response
$data = [];
foreach ($cur as $result) {
    $row = [];
    $row[] = $result->OCCUPATIONTITLE;
    $row[] = $result->COMPANYNAME;
    $row[] = $result->JOBSETTING;
    $row[] = $result->FULLNAME;
    $row[] = $result->JOBSTATUS;
    $row[] = '<a title="Edit" href="index.php?view=edit&id='.$result->JOBID.'" class="btn btn-primary btn-xs">  <span class="fa fa-edit fw-fa"></span></a>
              <a title="Delete" href="controller.php?action=delete&id='.$result->JOBID.'" class="btn btn-danger btn-xs  ">  <span class="fa  fa-trash-o fw-fa "></a>';
    $data[] = $row;
}

$output = [
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => $totalCount,
    "recordsFiltered" => $filteredCount,
    "data" => $data
];
echo json_encode($output);
?>