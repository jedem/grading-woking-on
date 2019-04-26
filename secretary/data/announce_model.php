<?php
    ob_start();
    $announce = new Announceclass();
    if(isset($_GET['q'])){
        $announce->$_GET['q']();
    }

    class Announceclass {

        function __construct(){
            if(!isset($_SESSION['id'])){
               header('location:../../');   
            }
        }

        //get all announcements
        function getannounce(){
                include('config2.php'); 
            $q = "select * from announcements";
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
        //get announce by id
        function getannouncebyid($id){
                include('config2.php'); 
            $q = "select * from announcements where id=$id";
            $r = mysqli_query($con,$q);
            
            return $r;
        }

        //create logs
        function logs($act){ 
            include('config2.php');            
            $date = date('m-d-Y h:i:s A');
            echo $q = "insert into log values(null,'$date','$act')";    
            mysqli_query($con,$q);
            return true;
        }

        //add student
        function addannounce(){
            include('../../config.php');
            $atitle = $_POST['atitle'];
            $ades = $_POST['ades'];
            $date = $_POST['date'];
            
            $q = "insert into announcements values('','$atitle','$ades','$date')";
            mysqli_query($con,$q);
            $act = "add new announcements $atitle";
            $this->logs($act);
            
            header('location:../announcement.php?r=added');
            exit();
        }

        //update announce
        function updateannounce(){
            include('../../config.php');
            $id = $_GET['id'];
            $atitle = $_POST['atitle'];
            $ades = $_POST['ades'];
            $date = $_POST['date'];
            $q = "update announcements set announce_title='$atitle', announce_des='$ades',date='$date' where id=$id";
            mysqli_query($con,$q);
            
            $act = "update announcement $atitle";
            $this->logs($act);
            header('location:../announcement.php?r=updated');
            exit();
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

            header('location:../announcement.php?r=deleted');
            exit();       
        }


        
    }
?>