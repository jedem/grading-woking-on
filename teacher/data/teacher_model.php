<?php
    ob_start();
    $teacher = new Datateacher();
    if(isset($_GET['q'])){
        $teacher->$_GET['q']();
    }
    class Datateacher {
        
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
        
        //get all teacher info
        function getteacher($search){
                include('config2.php'); 
            $q = "select * from teacher where teachid like '%$search%' or fname like '%$search%' or lname like '%$search%' order by lname,fname,teachid";
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
        //get teacher by ID
        function getteacherbyid($id){
                include('config2.php'); 
            $q = "select * from teacher where id=$id";
            $r = mysqli_query($con,$q);
            
            return $r;
        }
        //add teacher
        function addteacher(){
            include('../../config.php');
            $teachid = $_POST['teachid'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $mname = $_POST['mname'];

            $q1 = mysqli_query($con,"select * from teacher where teachid='$teachid'");
            if(mysqli_num_rows($q1) > 0){
                    header('location:../teacherlist.php?r=teachidtaken');
                    exit();
            }else {

                $q2 = mysqli_query($con,"select * from teacher where fname='$fname' and lname='$lname'");
                if(mysqli_num_rows($q2) > 0){
                     header('location:../teacherlist.php?r=haveaccount');
                      exit();
                }else {

                    $q = "insert into teacher values('','$teachid','$fname','$lname','$mname')";
                    mysqli_query($con,$q);
                    $name = $fname.' '.$lname;
                    $act = "add new teacher $name";
                    $this->logs($act);
                    header('location:../teacherlist.php?r=added');
                     exit();
                }
            }
     
        }
        
        //update teacher
        function updateteacher(){
            include('../../config.php');
            $id = $_GET['id'];
            $teachid = $_POST['teachid'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $mname = $_POST['mname'];

            $q = "update teacher set teachid='$teachid', fname='$fname', lname='$lname', mname='$mname' where id=$id";
            mysqli_query($con,$q);
            
            $name = $fname.' '.$lname;
            $act = "update teacher $name";
            $this->logs($act);
            
            header('location:../teacherlist.php?r=updated');
             exit();
        }
        
        //remove teacher from class
        function removesubject(){
            include('../../config.php');
            $classid = $_GET['classid'];
            $teachid = $_GET['teachid'];
            mysqli_query($con,"update class set teacher=null where id=$classid");
            header('location:../teacherload.php?id='.$teachid.'');
             exit();
            
            $tmp = mysqli_query($con,"select * from class where id=$classid");
            $tmp_row = mysqli_fetch_array($tmp);
            $tmp_subject = $tmp_row['subject'];
            $tmp_class = $tmp_row['course'].' '.$tmp_row['year'].'-'.$tmp_row['section'];
            
            $tmp = mysqli_query($con,"select * from teacher where id=$teachid");
            $tmp_row = mysqli_fetch_array($tmp);
            $tmp_teacher = $tmp_row['fname'].' '.$tmp_row['lname'];
            
            $act = "remove teacher $tmp_teacher from class $tmp_class with the subject of $tmp_subject";
            $this->logs($act);
            
        }
        
    }
?>