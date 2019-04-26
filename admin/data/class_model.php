<?php
    ob_start();
    $class = new Dataclass();
    if(isset($_GET['q'])){
        $class->$_GET['q']();
    }
    class Dataclass {
        
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
        
        //get all class info
        function getclass($search){
              include('config2.php');
            $s = mysqli_query($con,"select * from school_year");
            $data = mysqli_fetch_array($s);
            $sch_year = $data['sch_year'];
            $sem = $data['sem'];
            $q = "select * from class where sch_year='$sch_year' and sem='$sem' and (course like '%$search%' or year like '%$search%' or section like '%$search%' or sem like '%$search%' or subject like '%$search%') order by course,year,section,sem asc";
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
        function getclassbyid($id){
            include('config2.php');     
            $q = "select * from class where id=$id";
            $r = mysqli_query($con,$q);
            
            return $r;
        }


        //add class
        function addclass(){
            include('../../config.php');
            $course = $_POST['course'];
            $year = $_POST['year'];
            $section = $_POST['section'];
            $sem = $_POST['sem'];
            $subject = $_POST['subject'];
            $sy = $_POST['sy'];
            $time = $_POST['time'];
            $days = $_POST['days'];
            $room = $_POST['room'];
            
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
            

            $q1 = mysqli_query($con,"select * from class where subject='$subject' and section='$section'");
            $data = mysqli_fetch_array($q1);
            $status = $data['status'];
            if(mysqli_num_rows($q1) > 0 && $status == 'active'){

                 if($data['sem'] != $sem || $data['year'] != $year)
                 {
                            $q = "insert into class values('','$course','$year','$section','$sem','','$subject','$sy','active','$time','$days','$room')";
                            mysqli_query($con,$q);
                            $act = "create new class $course $year - $section with the subject of $subject";
                            $this->logs($act);
                            header('location:../class.php?r=added');
                                        exit();
                 }
                 else
                 {
                    header('location:../class.php?r=error');
                                exit();

                 }

            }else {
                $q = "insert into class values('','$course','$year','$section','$sem','','$subject','$sy','active','$time','$days','$room')";
                mysqli_query($con,$q);
                $act = "create new class $course $year - $section with the subject of $subject";
                $this->logs($act);
                header('location:../class.php?r=added');
                            exit();
            }

        }
        
        //update class
        function updateclass(){
            include('../../config.php');
            $id = $_GET['id'];
            $course = $_POST['course'];
            $year = $_POST['year'];
            $section = $_POST['section'];
            $sem = $_POST['sem'];
            $subject = $_POST['subject'];
            $sy = $_POST['sy'];
            $time = $_POST['time'];
            $days = $_POST['days'];
            $room = $_POST['room'];
            
            echo $q = "update class set course='$course', year='$year', section='$section', sem='$sem', subject='$subject', sch_year='$sy', time='$time', days='$days', room='$room' where id=$id";
            mysqli_query($con,$q);
            $act = "update class $course $year - $section with the subject of $subject";
            $this->logs($act);
            header('location:../class.php?r=updated');
                        exit();
        }
        
        //get all students in that class
        function getstudentsubject(){ 
                    include('config2.php');  
            $classid = $_GET['classid'];
            $q = "select * from studentsubject where classid=$classid";
            $r = mysqli_query($con,$q);
            $result = array();
            while($row = mysqli_fetch_array($r)){
                $q2 = 'select * from student where id='.$row['studid'].'';
                $r2 = mysqli_query($con,$q2);
                $result[] = mysqli_fetch_array($r2);
            }
            return $result;
        }
        
        //add student to class
        function addstudent(){
            include('../../config.php');  
            $classid = $_GET['classid'];
            $studid = $_GET['studid'];
            $verify = $this->verifystudent($studid,$classid);
            if($verify){
                echo $q = "INSERT INTO studentsubject (studid,classid) VALUES ('$studid', '$classid');";
                mysqli_query($con,$q);
                header('location:../classstudent.php?r=success&classid='.$classid.'');
                            exit();
            }else{
                header('location:../classstudent.php?r=duplicate&classid='.$classid.'');
                            exit();
            }
            
            $tmp = mysqli_query($con,"select * from class where id=$classid");
            $tmp_row = mysqli_fetch_array($tmp);
            $tmp_subject = $tmp_row['subject'];
            $tmp_class = $tmp_row['course'].' '.$tmp_row['year'].'-'.$tmp_row['section'];
            
            $tmp = mysqli_query($con,"select * from student where id=$studid");
            $tmp_row = mysqli_fetch_array($tmp);
            $tmp_student = $tmp_row['fname'].' '.$tmp_row['lname'];
            
            $act = "add student $tmp_student to class $tmp_class with the subject of $tmp_subject";
            $this->logs($act);
        }
        //verify if he/she is enrolled
        function verifystudent($studid,$classid){
            include('../../config.php');  
            $q = "select * from studentsubject where studid=$studid and classid=$classid";
            $r = mysqli_query($con,$q);
            if(mysqli_num_rows($r) < 1){
                return true;
            }else{
                return false;   
            }
        }
        //remove student to the class
        function removestudent(){
            $classid = $_GET['classid'];
            $studid = $_GET['studid'];
            include('../../config.php');  
            $q = "delete from studentsubject where studid=$studid and classid=$classid";
            mysqli_query($con,$q);
            
            $tmp = mysqli_query($con,"select * from class where id=$classid");
            $tmp_row = mysqli_fetch_array($tmp);
            $tmp_subject = $tmp_row['subject'];
            $tmp_class = $tmp_row['course'].' '.$tmp_row['year'].'-'.$tmp_row['section'];
            
            $tmp = mysqli_query($con,"select * from student where id=$studid");
            $tmp_row = mysqli_fetch_array($tmp);
            $tmp_student = $tmp_row['fname'].' '.$tmp_row['lname'];
            
            $act = "remove student $tmp_student from class $tmp_class with the subject of $tmp_subject";
            $this->logs($act);
            
            header('location:../classstudent.php?r=success&classid='.$classid.'');
                        exit();
        }
        
        //update teacher
        function updateteacher(){
            $classid = $_GET['classid'];
            $teachid = $_GET['teachid'];
            include('../../config.php'); 
            $q = "update class set teacher=$teachid where id=$classid";
            mysqli_query($con,$q);
            
            $tmp = mysqli_query($con,"select * from class where id=$classid");
            $tmp_row = mysqli_fetch_array($tmp);
            $tmp_subject = $tmp_row['subject'];
            $tmp_class = $tmp_row['course'].' '.$tmp_row['year'].'-'.$tmp_row['section'];
            
            $tmp = mysqli_query($con,"select * from teacher where id=$teachid");
            $tmp_row = mysqli_fetch_array($tmp);
            $tmp_teacher = $tmp_row['fname'].' '.$tmp_row['lname'];
            
            $act = "assign teacher $tmp_teacher to class $tmp_class with the subject of $tmp_subject";
            $this->logs($act);
            
            header('location:../classteacher.php?classid='.$classid.'&teacherid='.$teachid.'');
                        exit();
        }
        
    }

    
?>