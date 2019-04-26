<?php
include '../database/config.php';

$students_in_my_class = 0;
$active_examinations = 0;
$my_subjects = 0;
$passed_exam = 0;
$failed_exam = 0;
$attended_exams = 0;
$locked_exams = 0;
$notice = 0;
$A1 = 0;
$B2 = 0;
$B3 = 0;
$C4 = 0;
$C5 = 0;
$C6 = 0;
$D7 = 0;
$E8 = 0;
$F9 = 0;

$sql = "SELECT * FROM tbl_users WHERE category = '$mycategory'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $students_in_my_class++;
    }
} else {

}

$sql = "SELECT * FROM tbl_examinations WHERE category = '$mycategory' AND status = 'Active'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $active_examinations++;
    }
} else {

}


$sql = "SELECT * FROM tbl_subjects WHERE category = '$mycategory'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $my_subjects++;
    }
} else {

}

$sql = "SELECT * FROM tbl_assessment_records WHERE student_id = '$myid' AND status = 'PASS'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $passed_exam++;
    }
} else {

}

$sql = "SELECT * FROM tbl_assessment_records WHERE student_id = '$myid' AND status = 'FAIL'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $failed_exam++;
    }
} else {

}


$sql = "SELECT * FROM tbl_assessment_records WHERE student_id = '$myid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $attended_exams++;
    }
} else {

}


$sql = "SELECT * FROM tbl_examinations WHERE category = '$mycategory' AND status = 'Inactive'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $locked_exams++;
    }
} else {

}




// awarding Marks
$sql = "SELECT * FROM tbl_assessment_records";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $scoreV = $row['score'];
	 if ($score >= 80){
		 $A1++;
		 $A1r = "Excellen";
	 }else if ($score >= 70){
		 $B2++;
	 }else if ($score >= 60){
		 $B3++;
	 }else if ($score >= 55){
		 $C4++;
	 }else if ($score >= 50){
		 $C5++;
	 }else if ($score >= 45){
		 $C6++;
	 }else if ($score >= 40){
		 $D7++;
	 }else if ($score >= 35){
		 $E8++;
	 }

	  else{
		$F9++; 
		 
	 }
	 
    }
} else {

}


$sql = "SELECT * FROM tbl_notice";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
     $notice++;
    }
} else {

}
$conn->close();