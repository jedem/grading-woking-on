<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/announce_model.php');
error_reporting(E_ALL);
    $year = $announce->getyear();

	$announce = $announce->getannounce();
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                                       <h5 class="pull-right"><?php echo 'School Year : <strong>'.$year['sch_year'].'</strong> &nbsp;&nbsp; Quarter : <strong>'.$year['sem'].'</strong>';?></h5>
                <h1 class="page-header">
                    <small>ANNOUNCEMENTS</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        Announcements
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="form-inline form-padding">
                    <form action="class.php" method="post">                             
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addannounce">Add Announcements</button>
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
                            $classs='success';   
                        }else if($r=='updated'){
                            $classs='info';   
                        }else if($r=='deleted'){
                            $classs='danger';   
                        }else{
                            $classs='hide';
                        }
                    ?>
                    <div class="alert alert-<?php echo $classs?> <?php echo $classs; ?>">
                        <strong>Announcement successfully <?php echo $r; ?>!</strong>    
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
                                <th>Announcement Title</th>
                                <th>Announcement Description</th>
                                <th>Date Posted</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $c = 1; ?>
                            <?php while($row = mysqli_fetch_array($announce)): ?>                            
                                <tr>
                                    <td><?php echo $c;?></td>
                                    <td><?php echo $row['announce_title'];?></td>
                                    <td><?php echo $row['announce_des'];?></td>                            
                                    <td><?php echo $row['date'];?></td> <td>                                                                                             
                                        <a href="edit.php?type=announce&id=<?php echo $row['id']?>" title="update announce"><i class="fa fa-edit fa-2x text-primary"></i></a>
                                        <a href="data/announce_model.php?q=delete&table=announcements&id=<?php echo $row['id']?>" title="delete announce"><i class="fa fa-times-circle fa-2x text-danger confirmation"></i></a></td>
                                </tr>
                            <?php $c++; ?>
                            <?php endwhile; ?>
                            <?php if(mysqli_num_rows($announce) < 1): ?>
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