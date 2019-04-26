<?php

require_once("configure.php");

$filename = "Registered-Students.csv";
        
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");

//$sql = "SELECT * FROM tbl_products1 WHERE 1";
 $sql = "SELECT * FROM tbl_users WHERE role = 'student'";
try {
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
} catch (Exception $ex) {
    printErrorMessage($ex->getMessage());
}

$content = array();
//$title = array("Name", "Quantity", "Model", "Price", "Weight", "Status");
 $title = array("Id","Students Id", "First_name", "Last_name", "Gender", "DOB","Address","Email","Phone","Department","Category", "Status");


foreach ($results as $rs) {
    $row = array();
 $row[] = stripslashes($rs["id"]);
    $row[] = stripslashes($rs["user_id"]);
	 $row[] = stripslashes($rs["first_name"]);
	  $row[] = stripslashes($rs["last_name"]);
	   $row[] = stripslashes($rs["gender"]);
	    $row[] = stripslashes($rs["dob"]);
		 $row[] = stripslashes($rs["address"]);
		  $row[] = stripslashes($rs["email"]);
		   $row[] = stripslashes($rs["phone"]);
    $row[] = stripslashes($rs["department"]);
    $row[] = stripslashes($rs["category"]);
    $row[] = ($rs["acc_stat"] == "1") ? "Active" : "Inactive";
    
    $content[] = $row;
    
}

$output = fopen('php://output', 'w');
fputcsv($output, $title);
foreach ($content as $con) {
    fputcsv($output, $con);
}
?>
