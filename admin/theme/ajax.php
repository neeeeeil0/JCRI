<?php
require_once ("../../include/initialize.php");

    $mydb = new Database(); // Replace with your actual database connection class

    $sql = "SELECT count(*) as 'APPL' FROM `tbljobregistration` WHERE `PENDINGAPPLICATION`=1";
    $mydb->setQuery($sql);
    $pending = $mydb->loadSingleResult();

    echo $pending->APPL;
?>
