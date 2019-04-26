<?php
    ob_start();
    $settings = new Datasettings();
    if(isset($_GET['q'])){
        $settings->$_GET['q']();
    }

    class Datasettings {
        
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
        
        function setyear(){
         include('../../config.php');
          $from = $_POST['from'];
          $to = $_POST['to'];
          $sem = $_POST['sem'];
          $sch_year = $from.'-'.$to;
          if($from != "" && $to != "")
          {
              $q = mysqli_query($con,"update school_year set sch_year='$sch_year', sem='$sem' where id=1");
              $act = "set school year $sch_year";
                $this->logs($act);
               header('location:../schoolyear.php?msg=success');   
               exit();
          }else {
              header('location:../schoolyear.php?msg=error');   
              exit();
          }

        }

        function getyear(){
            include('config2.php');
             $s = mysqli_query($con,"select * from school_year");
            $data = mysqli_fetch_array($s);
            $sch_year = $data['sch_year'];
            $sem = $data['sem'];

            return $data;
        }
        function changepassword(){
            include('../../config.php');
            $username = $_GET['username'];
            $new = $_POST['new'];
            $confirm = $_POST['confirm'];
            if($new == $confirm){
                $r2 = mysqli_query($con,"update userdata set password='$new' where username='$username'");
                header('location:../settings.php?msg=success&username='.$username.'');   
                exit();
            }else{
                header('location:../settings.php?msg=error&username='.$username.'');  
                exit(); 
            }   
            
            $act = "update password of username $username";
            $this->logs($act);
        }
        
        function addaccount(){
            include('../../config.php');
            $level = $_GET['level'];
            $id = $_GET['id'];
            $q = "select * from $level where id=$id";
            $r = mysqli_query($con,$q);
            $row = mysqli_fetch_array($r);
            if($level == 'student'){
                $username = $row['studid'];                
                $fname = $row['fname'];
                $lname = $row['lname'];
                $password = $username;
            }else{
                $username = $row['teachid'];                
                $fname = $row['fname'];
                $lname = $row['lname'];
                $password = $username;
            }
            $verify = $this->verifyusername($username);
            if($verify){
                $q2 = "insert into userdata values(null,'$username','$password','$fname','$lname','$level')";
                mysqli_query($con,$q2);
                header('location:../'.$level.'list.php?r=added an account');
                exit();
            }else{
                  header('location:../'.$level.'list.php?r=has already an account'); 
                  exit();
            }
            
            $act = "add account with the username of $username";
            $this->logs($act);
            
        }

        function adduser(){
            include('../../config.php');
            $username = $_POST['username'];
            $password = $_POST['password'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $level = $_POST['level'];

            $verify = $this->verifyusername($username);
            if($verify){
                $q2 = "insert into userdata values(null,'$username','$password','$fname','$lname','$level')";
                mysqli_query($con,$q2);
                header('location:../users.php?r=added');
                exit();
            }else{
                   header('location:../users.php?r=already');
                  exit();
            }
            
            $act = "add account with the username of $username";
            $this->logs($act);
            
        }
        
        function verifyusername($user){
                include('config2.php'); 
            $q = "select * from userdata where username='$user'";
            $r = mysqli_query($con,$q);
            if(mysqli_num_rows($r) < 1){
               return true;
            }else{
                return false;   
            }
        }
        
        function getuser($search){
                include('config2.php'); 
            $user = $_SESSION['id'];
            $q = "select * from userdata where username !='$user' and username like '%$search%' order by lname asc";   
            $r = mysqli_query($con,$q);
            return $r;
        }
    }
?>