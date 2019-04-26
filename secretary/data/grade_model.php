<?php
    ob_start();
    $grade = new Gradeclass();
    if(isset($_GET['q'])){
        $grade->$_GET['q']();
    }

    class Gradeclass {

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

        function getsub($sub) {
                include('config2.php'); 
            $q = "select * from subject where code='$sub'";
            $r = mysqli_query($con,$q);
            $data = array();
            $data[] = mysqli_fetch_array($r);
            return $data;
        }

        function getyear(){
            include('config2.php');
             $s = mysqli_query($con,"select * from school_year");
            $data = mysqli_fetch_array($s);
            $sch_year = $data['sch_year'];
            $sem = $data['sem'];

            return $data;
        }
         function getsubid($id) {
                include('config2.php'); 
          $q = "select * from class where id=$id";
            $r = mysqli_query($con,$q);
            $data = array();
            $data[] = mysqli_fetch_array($r);
            return $data;
        }


        function acceptgrades(){
            include('../../config.php');
            $classid= $_POST['classid'];
            $teacher = $_POST['teacher'];

            $q = "update studentsubject set status='posted' where classid=$classid";
            $r = mysqli_query($con,$q);

            $sql = "SELECT * from class where id='$classid'";
            $result = mysqli_query($con,$sql);
            $data = mysqli_fetch_array($result);
            $subject = $data['subject'];

            $sql0 = "SELECT * FROM teacher where id='$teacher'";
            $result3 = mysqli_query($con,$sql0);
            $data3 = mysqli_fetch_array($result3);
            $teachid= $data3['teachid'];

            $sql2 = "SELECT * FROM subject where code='$subject'";
            $result2 = mysqli_query($con,$sql2);
            $data2 = mysqli_fetch_array($result2);
            $subjecttitle = $data2['title'];

            date_default_timezone_set('Asia/Hong_Kong');
             $today = date("F j, Y, g:i a");  

              $description = "Posted your submitted grade on";
            $q7 = "INSERT into notification(notif_description,teachid,subj_description,`date`,status,studid) values('$description','$teachid','$subjecttitle','$today','unread','admin')";
            mysqli_query($con,$q7);

            $act = "Accept grades";
            $this->logs($act);
            header('location:../studgrade.php?r=posted&classid="'.$classid.'"&teacher="'.$teacher.'"');
            exit();
        }

 

        function getteacher($teacher) {
                include('config2.php'); 
            $q = "select * from teacher where id=$teacher";
            $r = mysqli_query($con,$q);
            $data = array();
            $data[] = mysqli_fetch_array($r);
            return $data;
        }

        function getsubmittedgrades() {
                include('config2.php'); 
           $q = "select DISTINCT classid from studentsubject where status='submitted'";
            $r = mysqli_query($con,$q);
            $student = array();
            if(mysqli_num_rows($r) > 0){
               while($row = mysqli_fetch_array($r)){
                    $q2 = 'select * from class where id='.$row['classid'].'';  
                    $r2 = mysqli_query($con,$q2);
                    $student[] = mysqli_fetch_array($r2);    
                } 
            }
            return $student;


            
        }   

        function getstudentgrade($studid,$classid){
                include('config2.php'); 
            $q = "select * from studentsubject where classid=$classid and studid=$studid";
            $r = mysqli_query($con,$q);
            $data = array();
            $data[] = mysqli_fetch_array($r);
            return $data;
        }

         function getstudentbyclass($classid){
                include('config2.php'); 
            $q = "select * from studentsubject where classid=$classid";
            $r = mysqli_query($con,$q);
            $student = array();
            if($classid != null){
               while($row = mysqli_fetch_array($r)){
                    $q2 = 'select * from student where id='.$row['studid'].'';  
                    $r2 = mysqli_query($con,$q2);
                    $student[] = mysqli_fetch_array($r2);    
                } 
            }
            return $student;

            
        }

        //GLOBAL DELETION
        function delete(){
            include('../../config.php');
            $table = $_GET['table'];
            $id = $_GET['id'];
            $q = "delete from $table where id=$id";
            $r = mysqli_query($con,$q);
            
            $act = "delete $record from $table";
            $this->logs($act);

            header('location:../announcementh.php?r=deleted');
            exit();
                    
        }


        
    }
?>