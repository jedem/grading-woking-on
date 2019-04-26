<!DOCTYPE html>
<html>

<?php
session_start();

?>
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
 
    
    
<script> window.oncontextmenu = function () { console.log("Right Click Disabled"); return false; } </script> 

    
    </head>
    <body class="skin-black">
        <div class="container" style="margin-top:30px">
          <div class="col-md-4 col-md-offset-4">
              <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><strong></strong></h3></div>
            <div class="panel-body">
              <form role="form" method="post">
                <div class="form-group">
                  <label for="txt_username">Username</label>
                  <input type="text" class="form-control" style="border-radius:0px" name="txt_username" placeholder="Enter Username">
                </div>
                <div class="form-group">
                  <label for="txt_password">Password</label>
                  <input type="password" class="form-control" style="border-radius:0px" name="txt_password" placeholder="Enter Password">
                </div>
                <button type="submit" class="btn btn-sm btn-primary" name="btn_login">Log in</button>
              </form>
            </div>
          </div>
          </div>
        </div>

      <?php
        include "includes/connection.php";
        if(isset($_POST['btn_login']))
        { 
            $username = $_POST['txt_username'];
            $password = $_POST['txt_password'];


            $admin = mysqli_query($con, "SELECT * from tbladmin where username = '$username' and password = '$password' and accounttype = 'Administrator' ");
            $numrow = mysqli_num_rows($admin);

            $teacher = mysqli_query($con, "SELECT * from tblteacher where username = '$username' and password = '$password' ");
            $numrow1 = mysqli_num_rows($teacher);

            $student = mysqli_query($con, "SELECT * from tblstudent where username = '$username' and password = '$password' ");
                $numrow2 = mysqli_num_rows($student);

            if($numrow > 0)
            {
                while($row = mysqli_fetch_array($admin)){
                  $_SESSION['role'] = "Administrator";
                  $_SESSION['userid'] = $row['id'];
                }    
                header ('location: admin/dashboard/dashboard.php');
            }
            elseif($numrow1 > 0)
              {
                while($row = mysqli_fetch_array($teacher)){
                  $_SESSION['role'] = "Teacher";
                  $_SESSION['userid'] = $row['id'];
                } 
                header ('location: teacher/student/student.php');
              }
            elseif($numrow2 > 0)
                {
                  while($row = mysqli_fetch_array($student)){
                    $_SESSION['role'] = "Student";
                    $_SESSION['userid'] = $row['id'];
                  } 
                  header ('location: student/grade/grade.php');
                }
             else
                {
                  echo 'invalid account';
                  if(!isset($_SESSION['username'])){
    header ('Location: index.php');
}
                }
             
        }
        
      ?>

    </body>
</html>