<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/teacher_model.php');

    $year = $teacher->getyear();
    $search = isset($_POST['search']) ? $_POST['search']: null;
    $teacher = $teacher->getteacher($search);
    $classid = $_GET['classid'];

    $teacherid = $_GET['teachid'];
    if($teacherid == ""){
         $teacherbyid = "No assign teacher";
    }else {
        $rt = mysqli_query($con,"select * from teacher where id=$teacherid");
        $rs = mysqli_fetch_array($rt);
        $teacherbyid = $rs['fname'].' '.$rs['lname'];
    }
    
    $rc = mysqli_query($con,"select * from class where id=$classid");
    $rc = mysqli_fetch_array($rc);
    $subject = $rc['subject'];
    
    
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                 <h5 class="pull-right"><?php echo 'School Year : <strong>'.$year['sch_year'].'</strong> &nbsp;&nbsp; Quarter : <strong>'.$year['sem'].'</strong>';?></h5>
                <h1 class="page-header">
                    <small>CLASS TEACHER</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li>
                        <a href="class.php">Class Info</a>
                    </li>
                    <li class="active">
                        Class Teacher
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="form-inline form-padding">
                    <form action="classteacher.php?classid=<?php echo $classid;?>&teacherid=<?php echo $teacherid; ?>" method="post">
                        <input type="text" class="form-control" name="search" placeholder="Search by ID # or Name..." required autofocus>
                        <button type="submit" name="submitsearch" class="btn btn-success"><i class="fa fa-search"></i> Search</button>     
                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assignteacher">Assign Teacher</button>
                    
                    </form>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <?php if(isset($_GET['r'])): ?>
                    <?php
                        $r = $_GET['r'];
                        if($r=='assign'){
                            $class='success';   
                        }else if($r=='updated'){
                            $class='info';   
                        }else if($r=='deleted'){
                            $class='danger';   
                        }else{
                            $class='hide';
                        }
                    ?>
                    <div class="alert alert-<?php echo $class?> <?php echo $class; ?>">
                        <strong>Teacher successfully <?php echo $r; ?>!</strong>    
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-info">
                    <table>
                        <tr>
                            <td width="100"><strong>SUBJECT</strong></td>                            
                            <td> <?php echo $subject; ?> </td>
                        </tr>
                        <tr>
                            <td width="100"><strong>TEACHER</strong></td>                            
                            <td> <?php echo $teacherbyid; ?></td>
                        </tr>
                    </table>     
                </div>    
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->    
<?php include('include/modal.php');?>
<?php include('include/footer.php');?>