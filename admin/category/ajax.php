<?php
require_once("../../include/initialize.php");

$mydb = new Database(); // Replace with your actual database connection class

$columns = array("CATEGORY");

// Base query
$query = "
    SELECT *
    FROM tblcategory 
    WHERE 1 = 1
";

$search = "";
if (!empty($_POST["search"]["value"])) {
    $search = htmlspecialchars($_POST["search"]["value"], ENT_QUOTES);
    $query .= " AND (
        CATEGORY LIKE '%$search%'
    )";
}

// Ordering
if (!empty($_POST["order"])) {
    $columnIndex = intval($_POST['order']['0']['column']);
    $dir = in_array($_POST['order']['0']['dir'], ['asc', 'desc']) ? $_POST['order']['0']['dir'] : 'asc';
    $query .= " ORDER BY " . $columns[$columnIndex] . " " . $dir;
} else {
    $query .= " ORDER BY CATEGORY ASC";
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
    FROM tblcategory 
    WHERE 1 = 1
";

if (!empty($_POST["search"]["value"])) {
    $filteredCountQuery .= " AND (
        CATEGORY LIKE '%$search%'
    )";
}

$mydb->setQuery($filteredCountQuery);
$filteredCount = $mydb->loadSingleResult()->total;

// Total count query
$totalCountQuery = "
    SELECT COUNT(*) as total
    FROM tblcategory
";

$mydb->setQuery($totalCountQuery);
$totalCount = $mydb->loadSingleResult()->total;

// Prepare DataTable response
$data = [];
foreach ($cur as $result) {
    $row = [];
    $row[] = $result->CATEGORY;
    $row[] = '<a title="Edit" href="index.php?view=edit&id='.$result->CATEGORYID.'" class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></a>
              <a title="Delete" href="controller.php?action=delete&id='.$result->CATEGORYID.'" class="btn btn-danger btn-xs  ">  <span class="fa  fa-trash-o fw-fa "></a>';
    $data[] = $row;
}

$output = [
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => $totalCount,
    "recordsFiltered" => $filteredCount,
    "data" => $data
];

echo json_encode($output);