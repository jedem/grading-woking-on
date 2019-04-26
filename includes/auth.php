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
                }
             
        }
        
      ?>
