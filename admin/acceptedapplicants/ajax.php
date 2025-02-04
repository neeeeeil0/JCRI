<?php
require_once("../../include/initialize.php");

$mydb = new Database(); // Replace with your actual database connection class

$columns = array("aa.EMPLOYEEID", "jr.APPLICANT", "c.COMPANYNAME", "aa.JOBTITLE", "aa.HIREDDATE");

// Base query
$query = "
    SELECT * 
    FROM tblacceptedapplicants aa
    LEFT JOIN tbljobregistration jr ON jr.REGISTRATIONID = aa.REGISTRATIONID
    LEFT JOIN tbljob j ON j.JOBID = jr.JOBID
    LEFT JOIN tblapplicants a ON a.APPLICANTID = aa.APPLICANTID
    LEFT JOIN tblcompany c ON c.COMPANYID = aa.DEPLOYEDCOMPANYID
    WHERE 1 = 1
";

$search = "";
if (!empty($_POST["search"]["value"])) {
    $search = htmlspecialchars($_POST["search"]["value"], ENT_QUOTES);
    $query .= " AND (
        aa.EMPLOYEEID LIKE '%$search%' OR
        jr.APPLICANT LIKE '%$search%' OR
        c.COMPANYNAME LIKE '%$search%' OR
        aa.JOBTITLE LIKE '%$search%' OR
        aa.HIREDDATE LIKE '%$search%'
    )";
}

// Ordering
if (!empty($_POST["order"])) {
    $columnIndex = intval($_POST['order']['0']['column']);
    $dir = in_array($_POST['order']['0']['dir'], ['asc', 'desc']) ? $_POST['order']['0']['dir'] : 'asc';
    $query .= " ORDER BY " . $columns[$columnIndex] . " " . $dir;
} else {
    $query .= " ORDER BY jr.APPLICANT ASC";
}

// Pagination
if ($_POST["length"] != -1) {
    $start = intval($_POST['start']);
    $length = intval($_POST['length']);
    $query .= " LIMIT $start, $length";
}
$mydb->setQuery($query);
$cur = $mydb->loadResultList();

// Count filtered rows
$filteredCountQuery = "
    SELECT COUNT(*) as total 
    FROM tblacceptedapplicants aa
    LEFT JOIN tbljobregistration jr ON jr.REGISTRATIONID = aa.REGISTRATIONID
    LEFT JOIN tbljob j ON j.JOBID = jr.JOBID
    LEFT JOIN tblapplicants a ON a.APPLICANTID = aa.APPLICANTID
    LEFT JOIN tblcompany c ON c.COMPANYID = aa.DEPLOYEDCOMPANYID
    WHERE 1 = 1
";

if (!empty($_POST["search"]["value"])) {
    $filteredCountQuery .= " AND (
        aa.EMPLOYEEID LIKE '%$search%' OR
        jr.APPLICANT LIKE '%$search%' OR
        c.COMPANYNAME LIKE '%$search%' OR
        aa.JOBTITLE LIKE '%$search%' OR
        aa.HIREDDATE LIKE '%$search%'
    )";
}

$mydb->setQuery($filteredCountQuery);
$filteredCount = $mydb->loadSingleResult()->total;

// Total count query
$totalCountQuery = "
    SELECT COUNT(*) as total 
    FROM tblacceptedapplicants aa
    LEFT JOIN tbljobregistration jr ON jr.REGISTRATIONID = aa.REGISTRATIONID
    LEFT JOIN tbljob j ON j.JOBID = jr.JOBID
    LEFT JOIN tblapplicants a ON a.APPLICANTID = aa.APPLICANTID
    LEFT JOIN tblcompany c ON c.COMPANYID = aa.DEPLOYEDCOMPANYID
    WHERE 1 = 1
";

$mydb->setQuery($totalCountQuery);
$totalCount = $mydb->loadSingleResult()->total;

// Prepare DataTable response
$data = [];
foreach ($cur as $result) {
    $row = [];
    if(!$result->EMPLOYEEID){
        $row[] = '<a title="Edit" href="index.php?view=edit&id='.$result->ACCEPTEDID.'" style="color:blue;font-style:italic;">Click to Set Employee ID<a>';
    }else{
        $row[] = $result->EMPLOYEEID;
    }
    $row[] = $result->APPLICANT;
    $row[] = $result->COMPANYNAME;
    $row[] = $result->JOBTITLE;
    $row[] = date("M. j, Y, g:ia", strtotime($result->HIREDDATE));
    $row[] = '<a title="Edit" href="index.php?view=edit&id='.$result->ACCEPTEDID.'" class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></a>
              <a title="Delete" href="controller.php?action=delete&id='.$result->ACCEPTEDID.'" class="btn btn-danger btn-xs  ">  <span class="fa  fa-trash-o fw-fa "></a>';
    $data[] = $row;
}

$output = [
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => $totalCount,
    "recordsFiltered" => $filteredCount,
    "data" => $data
];

echo json_encode($output);