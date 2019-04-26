<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/data_model.php');
    
    // $search = isset($_POST['search']) ? $_POST['search']: null;
    // $subject = $data->getsubject($search);
    $year = $data->getyear();
    $curriculum = $data->getcurriculum();
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h5 class="pull-right"><?php echo 'School Year : <strong>'.$year['sch_year'].'</strong> &nbsp;&nbsp; Quarter : <strong>'.$year['sem'].'</strong>';?></h5>
                <h1 class="page-header">
                    <small>SUBJECT</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        Subject
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="form-inline form-padding">
    <!--                 <form action="subject.php" method="post"> -->
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="search" id="searchval" placeholder="Search Subject...">
                        <button type="submit" name="submitsearch" id="search" class="btn btn-success"><i class="fa fa-search"></i> Search</button>                                
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addsubject">Add Subject</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                    <div class="col-md-4">
                            <label>College</label>
                            <select name="collegess" id="collegess" class="form-control">
                            <option value="">College</option>
                            <option value="information">College of Information and Computing Science</option>
                            <option value="health">College of Health</option>
                            <option value="commerce">College of Commerce</option>
                            <option value="education">College of Education</option>
                            <option value="crim">College of Criminolgy</option>
                            <option value="engr">College of Engineering</option>
                             </select>
                    </div>

                    <div class="col-md-4">
                             <label>Course</label>
                             <select name="coursess" id="coursess" class="form-control">
                             <option value="">Course</option>
                             </select>
                    </div>

                    <div class="col-md-2">
                             <label>Curriculum Year</label>
                             <select name="curriculum" id="curriculum" class="form-control">     
                             <option value="">Curriculum Year</option>
                                <?php while($rowcurriculum = mysqli_fetch_array($curriculum)): ?>     
                             <option value="<?php echo $rowcurriculum['curriculum'];?>"><?php echo $rowcurriculum['curriculum'];?></option>
                             <?php endwhile; ?>
                             </select>
                    </div>

                    <div class="col-md-2">
                            <label style="color:transparent;">asdasdasdasdsadas</label>
                            <button type="button" class="btn btn-primary" id="searchcurriculum">Search by Curriculum</button>
                    </div>
            </div>
        </div>

<!--            </form> -->
        <!--/.row -->
        <hr />   
        <div class="row">
            <div class="col-lg-12">
                <?php if(isset($_GET['r'])): ?>
                    <?php
                        $r = $_GET['r'];
                        if($r=='added'){
                            $r ='Subject successfully added';
                            $class='success';   
                        }else if($r=='updated'){
                            $r ='Subject successfully updated';
                            $class='info';   
                        }else if($r=='deleted'){
                            $r ='Subject successfully deleted';
                            $class='danger';   
                        }else if($r=='error'){
                             $r ='Subject already exist';
                             $class='danger'; 
                        }else{
                            $class='hide';
                        }
                    ?>
                    <div class="alert alert-<?php echo $class?> <?php echo $class; ?>">
                        <strong><?php echo $r; ?>!</strong>    
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="tablesub" id="tablesub">

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<style>

</style>
<!-- /#page-wrapper -->    
<?php include('include/modal.php'); ?>
<?php include('include/footer.php'); ?>