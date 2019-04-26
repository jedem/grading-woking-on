<?php
    ob_start();
    $student = new Datastudent();
    if(isset($_GET['q'])){
        $student->$_GET['q']();
    }
    class Datastudent {
        
        function __construct(){
            if(!isset($_SESSION['id'])){
                header('location:../../');   
            }
        }
        
        //create logs
        function logs($act){        
            include('config2.php');    
            $date = date('m-d-Y h:i:s A');
            echo $q = "insert into log values(null,'$date','$act')";   
            mysqli_query($con,$q);
            return true;
        }
        
        //get all student info
        function getstudent($search){
            include('config2.php'); 
            $q = "select * from student where studid like '%$search%' or fname like '%$search%' or lname like '%$search%' order by lname,fname,studid";
            $r = mysqli_query($con,$q);
            
            return $r;
        }

        function getyear(){
            include('config2.php');
             $s = mysqli_query($con,"select * from school_year");
            $data = mysqli_fetch_array($s);
            $sch_year = $data['sch_year'];
            $sem = $data['sem'];

            return $data;
        }
        //get class by ID
        function getstudentbyid($id){
                include('config2.php'); 
            $q = "select * from student where id=$id";
            $r = mysqli_query($con,$q);
            
            return $r;
        }
        
        //add student
        function addstudent(){
            include('../../config.php');
            $studid = $_POST['studid'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $mname = $_POST['mname'];
            $college = $_POST['colleges'];
            $course = $_POST['courses'];
            $citizen = $_POST['citizen'];
            $status = $_POST['status'];
            $religion = $_POST['religion'];
            $gender = $_POST['gender'];
            $bday = $_POST['bday'];
            $address = $_POST['address'];
            $number = $_POST['pnumber'];
            $curriculum = $_POST['curriculum'];

            switch ($college) {
                case "information":
                    $college = "College of Information and Computing Science";
                    break;
                case "health":
                    $college = "College of Health";
                    break;
                case "commerce":
                    $college = "College of Commerce";
                    break;
                case "education":
                    $college = "College of Education";
                    break;
                case "crim":
                    $college = "College of Criminolgy";
                    break;
                case "engr":
                    $college = "College of Engineering";
                    break;
            }

            switch ($course) {
                case "cs":
                    $course = "Bachelor of Science in Computer Science";
                    break;
                case "it":
                    $course = "Bachelor of Science in Information Technology";
                    break;
                case "ce":
                    $course = "Bachelor of Science in Computer Engineering";
                    break;
                case "nurse":
                    $course = "Bachelor of Science in Nursing";
                    break;
                case "midwife":
                    $course = "Bachelor of Science in Midwife";
                    break;  
                case "midwirey":
                    $course = "Diploma in Midwirey";
                    break;   
                case "account":
                    $course = "Bachelor of Science in Accountancy";
                    break;    
                case "ba":
                    $course = "Bachelor of Science in Business Administration";
                    break;
                case "hrm":
                    $course = "Bachelor of Science in HRM";
                    break;
                case "se":
                    $course = "Bachelor of Science in Secondary Education";
                    break;
                case "educ":
                    $course = "Bachelor of Elementary Education";
                    break;
                case "crim":
                    $course = "Bachelor of Science in Criminology";
                    break;
                case "cpe":
                    $course = "Bachelor of Science in Civil Engineering";
                    break;
                case "ge":
                    $course = "Bachelor of Science in Geodetic Engineering";
                    break;
            }
            
            $q1 = mysqli_query($con,"select * from student where studid='$studid'");
            if(mysqli_num_rows($q1) > 0){
                    header('location:../studentlist.php?r=studidtaken');
                             exit();
            }else {

                $q2 = mysqli_query($con,"select * from student where fname='$fname' and lname='$lname'");
                if(mysqli_num_rows($q2) > 0){
                     header('location:../studentlist.php?r=haveaccount');
                              exit();
                }else {
                     $q = "insert into student values('','$studid','$fname','$lname','$mname','$college','$course','$citizen','$status','$religion','$gender','$bday','$address','$number','$curriculum')";
                    mysqli_query($con,$q);
                    $name = $fname.' '.$lname;
                    $act = "add new student $name";
                    $this->logs($act);     
                   header('location:../studentlist.php?r=added');
                            exit();
                }
            }
     

        }

        function getenrolledstudent($classid){
                include('config2.php'); 
            $q = "select * from studentsubject where classid=$classid";
            $r = mysqli_query($con,$q);
            $student = array();
            while($row = mysqli_fetch_array($r)){
                    $q2 = 'select * from student where id!='.$row['studid'].'';  
                    $r2 = mysqli_query($con,$q2);
                    $student[] = mysqli_fetch_array($r2);    
                } 

            return $student;

        }
        
        //update student
        function updatestudent(){
            include('../../config.php');
            $id = $_GET['id'];
            $studid = $_POST['studid'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $mname = $_POST['mname'];
            $college = $_POST['colleges'];
            $course = $_POST['courses'];
            $citizen = $_POST['citizen'];
            $status = $_POST['status'];
            $religion = $_POST['religion'];
            $gender = $_POST['gender'];
            $bday = $_POST['bday'];
            $address = $_POST['address'];
            $number = $_POST['pnumber'];
            $curriculum = $_POST['curriculum'];

            switch ($college) {
                case "information":
                    $college = "College of Information and Computing Science";
                    break;
                case "health":
                    $college = "College of Health";
                    break;
                case "commerce":
                    $college = "College of Commerce";
                    break;
                case "education":
                    $college = "College of Education";
                    break;
                case "crim":
                    $college = "College of Criminolgy";
                    break;
                case "engr":
                    $college = "College of Engineering";
                    break;
            }

            switch ($course) {
                case "cs":
                    $course = "Bachelor of Science in Computer Science";
                    break;
                case "it":
                    $course = "Bachelor of Science in Information Technology";
                    break;
                case "ce":
                    $course = "Bachelor of Science in Computer Engineering";
                    break;
                case "nurse":
                    $course = "Bachelor of Science in Nursing";
                    break;
                case "midwife":
                    $course = "Bachelor of Science in Midwife";
                    break;  
                case "midwirey":
                    $course = "Diploma in Midwirey";
                    break;   
                case "account":
                    $course = "Bachelor of Science in Accountancy";
                    break;    
                case "ba":
                    $course = "Bachelor of Science in Business Administration";
                    break;
                case "hrm":
                    $course = "Bachelor of Science in HRM";
                    break;
                case "se":
                    $course = "Bachelor of Science in Secondary Education";
                    break;
                case "educ":
                    $course = "Bachelor of Elementary Education";
                    break;
                case "crim":
                    $course = "Bachelor of Science in Criminology";
                    break;
                case "cpe":
                    $course = "Bachelor of Science in Civil Engineering";
                    break;
                case "ge":
                    $course = "Bachelor of Science in Geodetic Engineering";
                    break;
            }


            $q = "update student set studid='$studid', fname='$fname', lname='$lname', mname='$mname', college='$college', course='$course', citizenship='$citizen', civil='$status', religion='$religion', bday='$bday', address='$address', contact='$number', curriculum='$curriculum' where id=$id";
            mysqli_query($con,$q);
            
            $name = $fname.' '.$lname;
            $act = "update student $name";
            $this->logs($act);
            
            header('location:../studentlist.php?r=updated');
                     exit();
        }
        //remove from class
        function removesubject(){
            include('../../config.php');
            $studid = $_GET['studid'];
            $classid = $_GET['classid'];
            mysqli_query($con,"delete from studentsubject where studid=$studid and classid=$classid");
            
            $tmp = mysqli_query($con,"select * from class where id=$classid");
            $tmp_row = mysqli_fetch_array($tmp);
            $tmp_subject = $tmp_row['subject'];
            $tmp_class = $tmp_row['course'].' '.$tmp_row['year'].'-'.$tmp_row['section'];
            
            $tmp = mysqli_query($con,"select * from student where id=$studid");
            $tmp_row = mysqli_fetch_array($tmp);
            $tmp_student = $tmp_row['fname'].' '.$tmp_row['lname'];
            
            $act = "remove student $tmp_student from class $tmp_class with the subject of $tmp_subject";
            $this->logs($act);
            
            header('location:../studentsubject.php?id='.$studid.'');
                     exit()
;        }
    }
?>