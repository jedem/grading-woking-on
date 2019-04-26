<?php
    ob_start();
    $data = new Data();
    if(isset($_GET['q'])){
        $data->$_GET['q']();
    }
    class Data {
        
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
        
        function getyear(){
            include('config2.php');
             $s = mysqli_query($con,"select * from school_year");
            $data = mysqli_fetch_array($s);
            $sch_year = $data['sch_year'];
            $sem = $data['sem'];

            return $data;
        }
        //get all subjects
        function getsubject($search){
               include('config2.php');         
            $q = "select * from subject where code like '%$search%' or title like '%$search%' or curriculum like '%$search%' or college like '%$search%' or unit like '%$search%' order by code asc";
            $r = mysqli_query($con,$q);
            
            return $r;
        }
        //get subject by ID
        function getsubjectbyid($id){
               include('config2.php');         
            $q = "select * from subject where id=$id";
            $r = mysqli_query($con,$q);
            
            return $r;
        }

        function getcurriculum(){
              include('config2.php');         
            $q = "select distinct curriculum from subject";
            $r = mysqli_query($con,$q);
            
            return $r;
        }

         //assign teacher
        function assignteacher(){
            include('../../config.php');
            $id = $_POST['teacher'];
            $cid = $_POST['id'];

            $q = "update class set teacher='$id' where id=$cid";
            mysqli_query($con,$q);

            $act = "Assign teacher";
            $this->logs($act);
            header('location:../classteacher.php?r=assign&classid='.$cid.'&teachid='.$id.'');
            exit();
        }

        //assign teacher
        function enrollstudent(){
            include('../../config.php');
            $id = $_POST['student'];
            $cid = $_POST['id'];

            $q = "insert into studentsubject(`studid`,`classid`,`status`) values('$id','$cid','NA')";
            mysqli_query($con,$q);

            $act = "Enroll Student";
            $this->logs($act);
            header('location:../classstudent.php?r=enrolled&classid='.$cid.'');
            exit();
        }



        //add subject
        function addsubject(){
            include('../../config.php');
            $code = $_POST['code'];
            $title = $_POST['title'];
            $unit = $_POST['unit'];
            $prereq = $_POST['prereq'];
            $coreq = $_POST['coreq'];
            $course = $_POST['courses'];
            $college = $_POST['colleges'];
            $yearlevel = $_POST['yearlevel'];
            $semester = $_POST['semester'];
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

            $q1 = mysqli_query($con,"select * from subject where code='$code' OR title='$title'");
            if(mysqli_num_rows($q1) > 0){
                    header('location:../subject.php?r=error');
                    exit();
            }else {
                if($prereq == "" && $coreq == "")
                {
                    $q = "insert into subject values('','$code','$title','$unit','none','none','$curriculum','$semester','$yearlevel','$college','$course')";
                }
                else if($prereq != "" && $coreq == "")
                {
                     $q = "insert into subject values('','$code','$title','$unit','$prereq','none','$curriculum','$semester','$yearlevel','$college','$course')";
                }
                else if($prereq == "" && $coreq != "")
                {
                    $q = "insert into subject values('','$code','$title','$unit','none','$coreq','$curriculum','$semester','$yearlevel','$college','$course')";
                }
                else
                {
                    $q = "insert into subject values('','$code','$title','$unit','$prereq','$coreq','$curriculum','$semester','$yearlevel','$college','$course')";
                }

                mysqli_query($con,$q);

                $act = "add new subject $code - $title";
                $this->logs($act);
                header('location:../subject.php?r=added');
                exit();
            }
         
        }
        
        //update subject
        function updatesubject(){
            include('../../config.php');
            $id = $_GET['id'];
            $code = $_POST['code'];
            $title = $_POST['title'];
            $unit = $_POST['unit'];
            $prereq = $_POST['prereq'];
            $coreq = $_POST['coreq'];
            $course = $_POST['courses'];
            $college = $_POST['colleges'];
            $yearlevel = $_POST['yearlevel'];
            $semester = $_POST['semester'];
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
            $q = "update subject set code='$code', title='$title',unit=$unit, prereq='$prereq', corequisite='$coreq', curriculum='$curriculum', semester='$semester', year='$yearlevel', college='$college', course='$course' where id=$id";
            mysqli_query($con,$q);
            
            $act = "update subject $code - $title";
            $this->logs($act);
            header('location:../subject.php?r=updated');
            exit();
        }
        
        function deleteclass() {
            include('../../config.php');
            $table = $_GET['table'];
            $id = $_GET['id'];
            $q1 = mysqli_query($con,"select * from studentsubject where classid='$id'");
            if(mysqli_num_rows($q1) > 0){
                $q = "update $table set status='inactive' where id=$id";
                $r = null;
                $tmp = mysqli_query($con,"select * from $table where id=$id");
                $tmp_row = mysqli_fetch_array($tmp);
                mysqli_query($con,$q);
                if($table=='class'){
                     $record = $tmp_row['subject'];
                     header('location:../class.php?r=deleted');
                     exit();
                }
                $act = "delete $record from $table";
                $this->logs($act);
            }else {
                $q = mysqli_query($con,"delete from $table where id=$id");
                header('location:../class.php?r=deleted');
                exit();
                $act = "delete $record from $table";
                $this->logs($act);
            }

        }

        //GLOBAL DELETION
        function delete(){
            include('../../config.php');
            $table = $_GET['table'];
            $id = $_GET['id'];
            $q = "delete from $table where id=$id";
            $r = null;
            
            
            $tmp = mysqli_query($con,"select * from $table where id=$id");
            $tmp_row = mysql_fetch_array($tmp);
            
            mysqli_query($con,$q);
            
            if($table=='subject'){
                $record = $tmp_row['code'];
                header('location:../subject.php?r=deleted');
                exit();
                
            }else if($table=='class'){
                 $record = $tmp_row['subject'];
                header('location:../class.php?r=deleted');
                exit();
               
            }else if($table=='student'){
                $record = $tmp_row['fname'];
                header('location:../studentlist.php?r=deleted');
                exit();
               
            }else if($table=='teacher'){
               $record = $tmp_row['fname'];
                header('location:../teacherlist.php?r=deleted');
                exit();
            }else if($table=='userdata'){
                $record = $tmp_row['username'];
                header('location:../users.php?r=deleted');
                exit();
            }
                    
            $act = "delete $record from $table";
            $this->logs($act);
        }

    }
?>