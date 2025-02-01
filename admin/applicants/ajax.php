<?php
require_once ("../../include/initialize.php");
//ajax.php
$mydb = new Database(); // Replace with your actual database connection class

$column = array("j.REGISTRATIONID", "j.APPLICANT", "j2.OCCUPATIONTITLE", "c.COMPANYNAME", "j.REGISTRATIONDATE", "u.FULLNAME", "j.STATUS", "Action");

$query = "
    SELECT *
    FROM tblcompany c
    JOIN tbljobregistration j ON c.COMPANYID = j.COMPANYID
    JOIN tbljob j2 ON j.JOBID = j2.JOBID
    LEFT JOIN tblusers u ON j.MODIFIEDBY = u.USERID
    JOIN tblapplicants a ON j.APPLICANTID = a.APPLICANTID
    WHERE 1 = 1
";

// Job Title filter
if (!empty($_POST["job_title"])) {
    $job_id = intval($_POST["job_title"]);
    $query .= " AND j.JOBID = $job_id";
}

// Company filter
if (!empty($_POST["is_company"])) {
    $company_id = intval($_POST["is_company"]);
    $query .= " AND j.COMPANYID = $company_id";
}

// Company filter
if (!empty($_POST["job_status"])) {
    $status = $_POST["job_status"];
    $query .= " AND j.STATUS = '$status'";
}

// Search filter
if (!empty($_POST["search"]["value"])) {
    $search = htmlspecialchars($_POST["search"]["value"], ENT_QUOTES);
    $query .= " AND (
        j.REGISTRATIONID LIKE '%$search%' OR
        j.APPLICANT LIKE '%$search%' OR
        j2.OCCUPATIONTITLE LIKE '%$search%' OR
        c.COMPANYNAME LIKE '%$search%' OR
        u.FULLNAME LIKE '%$search%' OR
        j.STATUS LIKE '%$search%'
    )";
}

// Ordering
if (!empty($_POST["order"])) {
    $query .= " ORDER BY " . $column[$_POST['order']['0']['column']] . " " . $_POST['order']['0']['dir'];
} else {
    $query .= " ORDER BY j.REGISTRATIONID DESC";
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
    FROM tblcompany c
    JOIN tbljobregistration j ON c.COMPANYID = j.COMPANYID
    JOIN tbljob j2 ON j.JOBID = j2.JOBID
    LEFT JOIN tblusers u ON j.MODIFIEDBY = u.USERID
    JOIN tblapplicants a ON j.APPLICANTID = a.APPLICANTID
    WHERE 1 = 1
";
if (!empty($_POST["job_title"])) {
    $filteredCountQuery .= " AND j2.JOBID = $job_id";
}
if (!empty($_POST["is_company"])) {
    $filteredCountQuery .= " AND j.COMPANYID = $company_id";
}
if (!empty($_POST["job_status"])) {
    $filteredCountQuery .= " AND j.STATUS = '$status'";
}

if (!empty($_POST["search"]["value"])) {
    $filteredCountQuery .= " AND (
        j.REGISTRATIONID LIKE '%$search%' OR
        j.APPLICANT LIKE '%$search%' OR
        j2.OCCUPATIONTITLE LIKE '%$search%' OR
        c.COMPANYNAME LIKE '%$search%' OR
        u.FULLNAME LIKE '%$search%' OR
        j.STATUS LIKE '%$search%'
    )";
}
$mydb->setQuery($filteredCountQuery);
$filteredCount = $mydb->loadSingleResult()->total;

// Count total rows
$totalCountQuery = "
    SELECT COUNT(*) as total 
    FROM tblcompany c
    JOIN tbljobregistration j ON c.COMPANYID = j.COMPANYID
    JOIN tbljob j2 ON j.JOBID = j2.JOBID
    LEFT JOIN tblusers u ON j.MODIFIEDBY = u.USERID
    JOIN tblapplicants a ON j.APPLICANTID = a.APPLICANTID
    WHERE 1 = 1
";
$mydb->setQuery($totalCountQuery);
$totalCount = $mydb->loadSingleResult()->total;

// Prepare DataTable response
$data = [];
foreach ($cur as $result) {
    $row = [];
    $row[] = $result->REGISTRATIONID;
    $row[] = $result->APPLICANT;
    $row[] = $result->OCCUPATIONTITLE;
    $row[] = $result->COMPANYNAME;
    $row[] = $result->REGISTRATIONDATE;
    $row[] = $result->FULLNAME ?? "";
    $row[] = $result->STATUS;
    $row[] = '<a title="View" href="index.php?view=view&id=' . $result->REGISTRATIONID . '" class="btn btn-primary btn-xs">
                <span class="fa fa-edit fw-fa"></span></a>
              <a title="Remove" href="controller.php?action=delete&id=' . $result->REGISTRATIONID . '" class="btn btn-danger btn-xs">
                <span class="fa fa-trash-o fw-fa"></span></a>';
    $row['PENDINGAPPLICATION'] = $result->PENDINGAPPLICATION; 
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