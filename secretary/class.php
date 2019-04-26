<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/class_model.php');
    
    $year = $class->getyear();
    $search = isset($_POST['search']) ? $_POST['search']: null;
    $class = $class->getclass($search);

?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
              <h5 class="pull-right"><?php echo 'School Year : <strong>'.$year['sch_year'].'</strong> &nbsp;&nbsp; Quarter : <strong>'.$year['sem'].'</strong>';?></h5>
                <h1 class="page-header">
                    <small>CLASS INFORMATION</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        Class
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="form-inline form-padding">
                    <form action="class.php" method="post">
                        <input type="text" class="form-control" name="search" placeholder="Search Class Info...">
                        <button type="submit" name="submitsearch" class="btn btn-success"><i class="fa fa-search"></i> Search</button>                                
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addclass">Add Class</button>
                    </form>
                </div>
            </div>
        </div>
        <!--/.row -->
        <hr />   
        <div class="row">
            <div class="col-lg-12">
                <?php if(isset($_GET['r'])): ?>
                    <?php
                        $r = $_GET['r'];
                        if($r=='added'){
                            $r='Class info successfully added';
                            $classs='success';   
                        }else if($r=='updated'){
                            $r='Class info successfully updated';
                            $classs='info';   
                        }else if($r=='deleted'){
                            $r='Class info successfully deleted';
                            $classs='danger';   
                        }else if($r=='error'){
                            $r='Class already exist, Please select another section';
                            $classs='danger';  
                        }else{
                            $classs='hide';
                        }
                    ?>
                    <div class="alert alert-<?php echo $classs?> <?php echo $classs; ?>">
                        <strong><?php echo $r; ?>!</strong>    
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Class Name</th>
                                <th>School Year</th>
                                <th class="text-center">Semester</th>
                                
                                <th class="text-center">Teacher</th>
                                <th class="text-center">Students</th>
                                <th class="text-center">Days</th>
                                <th class="text-center">Room</th>
                                <th class="text-center">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $c = 1; ?>
                            <?php while($row = mysqli_fetch_array($class)): ?>                            
                                <tr>
                                  <?php if($row['status'] == 'active'){ ?>
                                    <td><?php echo $c;?></td>
                                    <td><?php echo $row['subject'];?></td>
                                    <td><?php echo $row['course'].' '.$row['year'].' - '.$row['section'];?></td>
                                     <td><?php echo $row['sch_year'];?></td>
                                    <td class="text-center"><?php echo $row['sem'];?></td>                                
                                                                  
                                    <td class="text-center"><a href="classteacher.php?classid=<?php echo $row['id'];?>&teachid=<?php echo $row['teacher'];?>" title="update teacher">View</a></td>
                                    <td class="text-center"><a href="classstudent.php?classid=<?php echo $row['id'];?>" title="update students" title="add student">View</a></td>
                                    <td><?php echo $row['time'];?></td>
                                    <td><?php echo $row['days'];?></td>
                                    <td><?php echo $row['room'];?></td>
                                    <td class="text-center">                                                                               
                                        <a href="edit.php?type=class&id=<?php echo $row['id']?>" title="update class"><i class="fa fa-edit fa-2x text-primary"></i></a>
                                        <a href="data/data_model.php?q=deleteclass&table=class&id=<?php echo $row['id']?>" title="delete class"><i class="fa fa-times-circle fa-2x text-danger confirmation"></i></a></td>

                                </tr>

                            <?php
                                }else {
                                    
                                }
                             $c++; ?>
                            <?php endwhile; ?>

                            <?php if(mysqli_num_rows($class) < 1): ?>
                                <tr>
                                    <td colspan="7" class="bg-danger text-danger text-center">*** EMPTY ***</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->    
<?php include('include/modal.php'); ?>
<?php include('include/footer.php'); ?>