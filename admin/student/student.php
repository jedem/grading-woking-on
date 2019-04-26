<!DOCTYPE html>
<html>
    <?php include('../head_css.php'); 
	require_once("configure.php");
	
	
	
	?>
	<script> window.oncontextmenu = function () { console.log("Right Click Disabled"); return false; } </script> 


    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        ob_start();
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Student
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                            <?php
                            if(($_SESSION['role']) == "Administrator")
                            {
                            ?>

                            <div class="box">
                                <div class="box-header">
                                    <div style="padding:10px;">
									
									
									
   
    <a href="import-csv.php" title="Import CSV" ><img src="buttons/button_import.png" alt="Import CSV" width="151" height="38"> </a>   
	<a href="export-csv.php" title="Export CSV" ><img src="buttons/button_export.png" alt="Export CSV" width="148" height="38"> </a>    
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addStudModalimport"><i class="fa fa-fw fa-folder-open" aria-hidden="true"></i> Load from Excel file</button>  
<!-- /.box-header -->
     <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addStudModal"><i class="fa fa-plus" aria-hidden="true"></i> Add Student</button>  
    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 
									                     <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addStudModalimport"><i class="fa fa-fw fa-folder-open" aria-hidden="true"></i> Load from Excel file</button>  
<!--<a href="index-Import-Export.php" class="btn btn-info" role="button"  class="fa fa-fw fa-folder-open"  >Link Button</a>
<button type="button" class="btn btn-info">Button</button>
<input type="button" class="btn btn-info" value="Input Button">
<input type="submit" class="btn btn-info" value="Submit Button">-->

                                
                                    </div>                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /></th>
                                                <th>Student Name</th>
                                                <th>Contact</th>
                                                <th>Address</th>
                                                <th>Username</th>
                                                <th style="width: 40px !important;">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $squery = mysqli_query($con, "select *,CONCAT(lname, ', ', fname, ' ',mname) as sname from tblstudent");
                                            while($row = mysqli_fetch_array($squery))
                                            {
                                                echo '
                                                <tr>
                                                    <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$row['id'].'" /></td>
                                                    <td>'.$row['sname'].'</td>
                                                    <td>'.$row['contact'].'</td>
                                                    <td>'.$row['address'].'</td>
                                                    <td>'.$row['username'].'</td>
                                                    <td><button class="btn btn-primary btn-sm" data-target="#editModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                                                </tr>
                                                ';
                                                
                                                include "editModal.php";
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <?php include "../deleteModal.php"; ?>

                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            <?php
                            }
                            else if(($_SESSION['role']) == "Teacher")
                            {
                            ?>
							 <div class="box">
                                
								
								<div class="box-header">
                                    <div style="padding:10px;">
                                        <form method="post">
                                        <div class="form-group">
                                            <div class="col-md-2">
                                            <select required name="ddl_yl" id="ddl_yl" data-style="btn-primary" class="form-control input-sm">
                                                <option value="" selected disabled>-- Select Year Level --</option>
                                                <?php
                                                    $q = mysqli_query($con,"SELECT * from tblschoolyear");
                                                    while($row=mysqli_fetch_array($q)){
                                                        echo '<option value="'.$row['id'].'">'.$row['schoolyear'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                            </div>

                                            <div class="col-md-2">
                                            <select required name="ddl_class" id="ddl_class" data-style="btn-primary" class="form-control input-sm">
                                                <option value="" selected disabled>-- Select Class --</option>
                                                <?php
                                                    $q = mysqli_query($con,"SELECT * from tblclass");
                                                    while($row=mysqli_fetch_array($q)){
                                                        echo '<option value="'.$row['id'].'">'.$row['classname'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                            </div>
                                            
                                            <div class="col-md-2">
                                            <select required name="ddl_subj" id="ddl_subj" data-style="btn-primary" class="form-control input-sm">
                                                <option value=""  selected disabled>-- Select Subject --</option>
                                                <?php
                                                    $q = mysqli_query($con,"SELECT * from tblsubjects");
                                                    while($row=mysqli_fetch_array($q)){
                                                        echo '<option value="'.$row['id'].'">'.$row['subjectname'].' - '.$row['description'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-sm" name="btn_search"><i class="fa fa-search" aria-hidden="true"></i> Search</button> 

                                        </div>
                                        </form>
                                
                                    </div>                                
                                </div><!-- /.box-header -->
                                
								
								
								<div class="box-body table-responsive">
                                    <?php
                                    if(isset($_POST['btn_search']))
                                    {
                                    ?>
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /></th>
                                                <th>Last Name</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if((!isset($_POST['ddl_yl'])) & (!isset($_POST['ddl_class'])) & (!isset($_POST['ddl_subj'])) )
                                            {
                                                $squery = mysqli_query($con, "SELECT * 
                                                                        FROM  tblstudent s
                                                                        LEFT JOIN tblstudentclass sc ON sc.studentid = s.id
                                                                        LEFT JOIN tblsubjects sb ON sc.subjectid = sb.id
                                                                        LEFT JOIN tblclass c ON sc.classid = c.id
                                                                        LEFT JOIN tblyearlevel y ON c.yearlevelid = y.id ");
                                            }
                                            /*else if((isset($_POST['ddl_yl'])) & (!isset($_POST['ddl_class'])) & (!isset($_POST['ddl_subj'])) )
                                            {
                                                $squery = mysqli_query($con, "SELECT * 
                                                                        FROM  tblstudent s
                                                                        LEFT JOIN tblstudentclass sc ON sc.studentid = s.id
                                                                        LEFT JOIN tblsubjects sb ON sc.subjectid = sb.id
                                                                        LEFT JOIN tblclass c ON sc.classid = c.id
                                                                        LEFT JOIN tblyearlevel y ON c.yearlevelid = y.id 
                                                                        WHERE c.yearlevelid = '".$_POST['ddl_yl']."'");
                                            }
                                            else if((isset($_POST['ddl_yl'])) & (!isset($_POST['ddl_class'])) & (!isset($_POST['ddl_subj'])) )
                                            {
                                                $squery = mysqli_query($con, "SELECT * 
                                                                        FROM  tblstudent s
                                                                        LEFT JOIN tblstudentclass sc ON sc.studentid = s.id
                                                                        LEFT JOIN tblsubjects sb ON sc.subjectid = sb.id
                                                                        LEFT JOIN tblclass c ON sc.classid = c.id
                                                                        LEFT JOIN tblyearlevel y ON c.yearlevelid = y.id 
                                                                        WHERE c.yearlevelid = '".$_POST['ddl_yl']."'");
                                            }*/
                                            else{
                                                $squery = mysqli_query($con, "SELECT * 
                                                                        FROM  tblstudent s
                                                                        LEFT JOIN tblstudentclass sc ON sc.studentid = s.id
                                                                        LEFT JOIN tblsubjects sb ON sc.subjectid = sb.id
                                                                        LEFT JOIN tblclass c ON sc.classid = c.id
                                                                        LEFT JOIN tblyearlevel y ON c.yearlevelid = y.id
                                                                        WHERE c.yearlevelid = '".$_POST['ddl_yl']."'
                                                                        and sc.id = '".$_POST['ddl_class']."'
                                                                        and sc.subjectid = '".$_POST['ddl_subj']."' ");
                                            }

                                            while($row = mysqli_fetch_array($squery))
                                            {
                                                echo '
                                                <tr>
                                                    <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$row['id'].'" /></td>
                                                    <td>'.$row['lname'].'</td>
                                                    <td>'.$row['fname'].'</td>
                                                    <td>'.$row['mname'].'</td>
                                                </tr>
                                                ';
                                                
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /></th>
                                                <th>Last Name</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                                $squery = mysqli_query($con, "SELECT * 
                                                                        FROM  tblstudent s
                                                                        LEFT JOIN tblstudentclass sc ON sc.studentid = s.id
                                                                        LEFT JOIN tblsubjects sb ON sc.subjectid = sb.id
                                                                        LEFT JOIN tblclass c ON sc.classid = c.id
                                                                        LEFT JOIN tblyearlevel y ON c.yearlevelid = y.id ");
                                            
                                            while($row = mysqli_fetch_array($squery))
                                            {
                                                echo '
                                                <tr>
                                                    <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$row['id'].'" /></td>
                                                    <td>'.$row['lname'].'</td>
                                                    <td>'.$row['fname'].'</td>
                                                    <td>'.$row['mname'].'</td>
                                                </tr>
                                                ';
                                                
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                    }
                                    ?>


                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            <?php
                            }
                            ?>

            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>
 <?php include "addModal.php"; ?>
            <?php include "../addfunction.php"; ?>
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>


                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php include "../footer.php"; ?>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>


















































<?php

require_once("configure.php");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="http://www.thesoftwareguy.in/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import and Export CSV with PHP And MySql - thesoftwareguy</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body>

<div id="container">
<div id="body">
    <div class="mainTitle" >Import and Export CSV with PHP And MySql</div>
    <div style="text-align:center;">
    <a href="import-csv.php" title="Import CSV" ><img src="buttons/button_import.png" alt="Import CSV" width="151" height="38"> </a>   
	<a href="export-csv.php" title="Export CSV" ><img src="buttons/button_export.png" alt="Export CSV" width="148" height="38"> </a>    
    <a href="../index.php" title="HOME" ><img src="buttons/Splash_Screen.jpg" alt="HOME" width="148" height="38"> </a>    
   
    <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat" class="fa fa-refresh fa-spin fa-2x" ><i class="fa fa-fw fa-folder-open" ></i> New user from file</a>
        
			
	</div>
    
    
	<div style="width:35%;float: left;margin:0 auto;text-align: center;">
		<!-- Place this tag where you want the widget to render. -->
		<div class="g-person" data-href="https://plus.google.com/116523474604785207782"  data-rel="author" data-layout="potrait"></div>

		<!-- Place this tag after the last widget tag. -->
		<script type="text/javascript">
			(function() {
				var po = document.createElement('script');
				po.type = 'text/javascript';
				po.async = true;
				po.src = 'https://apis.google.com/js/platform.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(po, s);
			})();
		</script>
	</div>
	<div style="width:30%;float: left;margin:0 auto;text-align: center;">
		
		<script type="text/javascript">
		window.twttr = (function (d, s, id) {
		var t, js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src= "https://platform.twitter.com/widgets.js";
		fjs.parentNode.insertBefore(js, fjs);
		return window.twttr || (t = { _e: [], ready: function (f) { t._e.push(f) } });
		}(document, "script", "twitter-wjs"));
		</script>
	</div>
</div>
    
   <footer>
        <div class="copyright">
        &copy; 2018 <a href="http://www.thesoftwareguy.in" target="_blank">thesoftwareguy</a>. All rights reserved
        </div>
        <div class="footerlogo"><a href="http://www.thesoftwareguy.in" target="_blank"><img src="http://www.thesoftwareguy.in/thesoftwareguy-logo-small.png	" width="200" height="47" alt="thesoftwareguy logo" /></a> </div>
   </footer>
</div></div>

</body>
</html>













