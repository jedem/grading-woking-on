<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/data_model.php');
    include('data/class_model.php');
    include('data/student_model.php');
    include('data/teacher_model.php');
    include('data/announce_model.php');

    $year = $class->getyear();
    $id = $_GET['id'];
    $subject = $data->getsubjectbyid($id);
    $class = $class->getclassbyid($id);
    $student = $student->getstudentbyid($id);
    $teacher = $teacher->getteacherbyid($id);
    $announce = $announce->getannouncebyid($id);
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                            <h5 class="pull-right"><?php echo 'School Year : <strong>'.$year['sch_year'].'</strong> &nbsp;&nbsp; Quarter : <strong>'.$year['sem'].'</strong>';?></h5>
                <h1 class="page-header">
                    <small>EDIT</small>
                </h1>
                <?php 
                    $edit = new Edit();
                    $type = $_GET['type'];
                    if($type=='subject'){
                        $edit->editsubject($subject);
                    }else if($type=='class'){
                        $edit->editclass($class);
                    }else if($type=='student'){
                        $edit->editstudent($student);   
                    }else if($type=='teacher'){
                        $edit->editteacher($teacher);   
                    }else if($type=='announce'){
                        $edit->editannounce($announce);
                    }
                ?>
            </div>
        </div>
        <!-- /.row -->

       

 
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->    

<?php include('include/footer.php');

class Edit {
    
    function editsubject($subject){ ?>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
            </li>
            <li>
                <a href="subject.php">Subject</a>
            </li>
            <li class="active">
                Edit
            </li>
        </ol>
        <hr />
        <div class="modal-body">
            <?php while($row = mysqli_fetch_array($subject)): ?>
            <form action="data/data_model.php?q=updatesubject&id=<?php echo $row['id'];?>" method="post">

                <div class="form-group">
                 <label>Curriculum</label>
                    <input type="text" class="form-control" name="curriculum" value="<?php echo $row['curriculum']?>">
                </div>

                <div class="form-group">
                 <label>Semester</label>
                    <select name="semester" class="form-control">
                        <option value="">Semester</option>
                        <option <?php  if($row['semester'] == '1st') echo "selected"?>>1st</option>
                        <option <?php  if($row['semester'] == '2nd') echo "selected"?>>2nd</option>
                        <option <?php  if($row['semester'] == 'Semester') echo "selected"?>>Summer</option>
                    </select>
                </div>


                <div class="form-group">
                 <label>Year</label>
                    <select name="yearlevel" class="form-control">
                        <option value="">Year</option>
                        <option <?php  if($row['year'] == '1') echo "selected"?>>1</option>
                        <option <?php  if($row['year'] == '2') echo "selected"?>>2</option>
                        <option <?php  if($row['year'] == '3') echo "selected"?>>3</option>
                        <option <?php  if($row['year'] == '4') echo "selected"?>>4</option>
                        <option <?php  if($row['year'] == '5') echo "selected"?>>5</option>
                    </select>
                </div>

                <div class="form-group">
                      <label>College</label>
                       <select name="colleges" id="colleges" class="form-control">
                        <option value="<?php 

                            switch ($row['college']) {
                                case "College of Information and Computing Science":
                                    echo "information";
                                    break;
                                case "College of Health":
                                    echo "health";
                                    break;
                                case "College of Commerce":
                                    echo "commerce";
                                    break;
                                case "College of Education":
                                    echo "education";
                                    break;
                                case "College of Criminolgy":
                                    echo "crim";
                                    break;
                                case "College of Engineering":
                                    echo "engr";
                                    break;
                            }

                        ?>" selected><?php echo $row['college'];?></option>
                        <option value="information">College of Information and Computing Science</option>
                        <option value="health">College of Health</option>
                        <option value="commerce">College of Commerce</option>
                        <option value="education">College of Education</option>
                        <option value="crim">College of Criminolgy</option>
                        <option value="engr">College of Engineering</option>
                         </select>
                </div>

                <div class="form-group">
                  <label>Course</span></label>
                       <select name="courses" id="courses" class="form-control" >
                        <option value="<?php 
                           switch ($row['course']) {
                                case "Bachelor of Science in Computer Science":
                                    echo "cs";
                                    break;
                                case "Bachelor of Science in Information Technology":
                                    echo "it";
                                    break;
                                case "Bachelor of Science in Computer Engineering":
                                    echo "ce";
                                    break;
                                case "Bachelor of Science in Nursing":
                                    echo "nurse";
                                    break;
                                case "Bachelor of Science in Midwife":
                                    echo "midwife";
                                    break;  
                                case "Diploma in Midwirey":
                                    echo "midwirey";
                                    break;   
                                case "Bachelor of Science in Accountancy":
                                    echo "account";
                                    break;    
                                case "Bachelor of Science in Business Administration":
                                    echo "ba";
                                    break;
                                case "Bachelor of Science in HRM":
                                    echo "hrm";
                                    break;
                                case "Bachelor of Science in Secondary Education":
                                    echo "se";
                                    break;
                                case "Bachelor of Elementary Education":
                                    echo "educ";
                                    break;
                                case "Bachelor of Science in Criminology":
                                    echo "crim";
                                    break;
                                case "Bachelor of Science in Civil Engineering":
                                    echo "cpe";
                                    break;
                                case "Bachelor of Science in Geodetic Engineering":
                                    echo "ge";
                                    break;
                            }

                        ?>" selected><?php echo $row['course'];?></option>
                         </select>
                </div>

                <div class="form-group">
                    <label>Subject Code</label>
                    <input type="text" class="form-control" value="<?php echo $row['code']; ?>" name="code" placeholder="subject code" />
                </div>
                <div class="form-group">
                    <label>Subject Title</label>
                    <input type="text" class="form-control" value="<?php echo $row['title']; ?>" name="title" placeholder="subject title" />
                </div>
                <div class="form-group">
                    <label>No. Of Units</label>
                    <input type="number" min="1" max="5" class="form-control" value="<?php echo $row['unit']; ?>" name="unit" placeholder="no. of units" />
                </div>
                      <div class="form-group">
                    <label>Prerequisite</label>
                    <input type="text"  class="form-control" value="<?php echo $row['prereq']; ?>" name="prereq" placeholder="no. of units" />
                </div>
                               <div class="form-group">
                    <label>Corequisite</label>
                    <input type="text"  class="form-control" value="<?php echo $row['corequisite']; ?>" name="coreq" placeholder="no. of units" />
                </div>
        </div>
        <div class="modal-footer">
            <a href="subject.php"><button type="button" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button></a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
            <?php endwhile; ?>
            </form>
        </div>
        
<?php    }
    
    function editclass($class){ ?>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
            </li>
            <li>
                <a href="class.php">Class Info</a>
            </li>
            <li class="active">
                Edit
            </li>
        </ol>
        <hr />
        <div class="modal-body">
            <?php while($row = mysqli_fetch_array($class)): ?>
            <form action="data/class_model.php?q=updateclass&id=<?php echo $row['id']?>" method="post">
                <div class="form-group">  
                    <select name="subject" class="form-control">
                        <option value="">Select Subject...</option>
                    <?php 
                        include('data/config2.php');
                        $r = mysqli_query($con,"select * from subject");
                        while($re = mysqli_fetch_array($r)):
                    ?>  
                        <option <?php  if($row['subject'] == $re['code']) echo "selected"?> value="<?php echo $re['code']; ?>"><?php echo $re['code']; ?> - (<?php echo $re['title']; ?>)</option>
                    <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="course" class="form-control">
                        <option value="">Select Course...</option>
                        <option <?php  if($row['course'] == 'BSIT') echo "selected"?>>BSIT</option>
                        <option <?php  if($row['course'] == 'BSCRIM') echo "selected"?>>BSCRIM</option>
                        <option <?php  if($row['course'] == 'BSAT') echo "selected"?>>BSAT</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="year" class="form-control">
                        <option value="">Select Year...</option>
                        <option <?php  if($row['year'] == '1') echo "selected"?>>1</option>
                        <option <?php  if($row['year'] == '2') echo "selected"?>>2</option>
                        <option <?php  if($row['year'] == '3') echo "selected"?>>3</option>
                        <option <?php  if($row['year'] == '4') echo "selected"?>>4</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="section" class="form-control">
                        <option value="">Select Section...</option>
                        <option <?php  if($row['section'] == 'A') echo "selected"?>>A</option>
                        <option <?php  if($row['section'] == 'B') echo "selected"?>>B</option>
                        <option <?php  if($row['section'] == 'C') echo "selected"?>>C</option>
                        <option <?php  if($row['section'] == 'D') echo "selected"?>>D</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="sem" class="form-control" readonly value="<?php echo $row['sem']; ?>">
                </div>
                
                <div class="form-group">
                <input type="text" name="sy" class="form-control" readonly value="<?php echo $row['sch_year']; ?>">
                </div>

                <div class="form-group">
                <input type="text" name="time" placeholder="time" class="form-control" value="<?php echo $row['time']; ?>">
                </div>

                <div class="form-group">
                <input type="text" name="days" placeholder="days" class="form-control" value="<?php echo $row['days']; ?>">
                </div>

                <div class="form-group">
                <input type="text" name="room" placeholder="room" class="form-control" value="<?php echo $row['room']; ?>">
                </div>
        </div>
        <div class="modal-footer">
            <a href="class.php"><button type="button" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button></a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
            </form>
            <?php endwhile; ?>
        </div>
    <?php
    }
    
    function editstudent($student){ ?>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
            </li>
            <li>
                <a href="studentlist.php">Student's List</a>
            </li>
            <li class="active">
                Edit
            </li>
        </ol>
        <hr />
        <div class="modal-body">
            <?php while($row = mysqli_fetch_array($student)): ?>
            <form action="data/student_model.php?q=updatestudent&id=<?php echo $row['id'];?>" method="post">


                    <div class="form-group row">
                    <div class="col-xs-4">
                            <label>Student ID<span style="color:red;"> *</span></label>
                        <input type="text" class="form-control" name="studid" placeholder="student ID" value="<?php echo $row['studid']; ?>"/>
                    </div>

                     <div class="col-xs-4">
                                 <label>College<span style="color:red;"> *</span></label>
                       <select name="colleges" id="colleges" class="form-control">
                        <option value="<?php 

                            switch ($row['college']) {
                                case "College of Information and Computing Science":
                                    echo "information";
                                    break;
                                case "College of Health":
                                    echo "health";
                                    break;
                                case "College of Commerce":
                                    echo "commerce";
                                    break;
                                case "College of Education":
                                    echo "education";
                                    break;
                                case "College of Criminolgy":
                                    echo "crim";
                                    break;
                                case "College of Engineering":
                                    echo "engr";
                                    break;
                            }

                        ?>" selected><?php echo $row['college'];?></option>
                        <option value="information">College of Information and Computing Science</option>
                        <option value="health">College of Health</option>
                        <option value="commerce">College of Commerce</option>
                        <option value="education">College of Education</option>
                        <option value="crim">College of Criminolgy</option>
                        <option value="engr">College of Engineering</option>
                         </select>
                   </div>


                     <div class="col-xs-4">
                        <label>Course<span style="color:red;"> *</span></label>
                       <select name="courses" id="courses" class="form-control" >
                        <option value="<?php 
                           switch ($row['course']) {
                                case "Bachelor of Science in Computer Science":
                                    echo "cs";
                                    break;
                                case "Bachelor of Science in Information Technology":
                                    echo "it";
                                    break;
                                case "Bachelor of Science in Computer Engineering":
                                    echo "ce";
                                    break;
                                case "Bachelor of Science in Nursing":
                                    echo "nurse";
                                    break;
                                case "Bachelor of Science in Midwife":
                                    echo "midwife";
                                    break;  
                                case "Diploma in Midwirey":
                                    echo "midwirey";
                                    break;   
                                case "Bachelor of Science in Accountancy":
                                    echo "account";
                                    break;    
                                case "Bachelor of Science in Business Administration":
                                    echo "ba";
                                    break;
                                case "Bachelor of Science in HRM":
                                    echo "hrm";
                                    break;
                                case "Bachelor of Science in Secondary Education":
                                    echo "se";
                                    break;
                                case "Bachelor of Elementary Education":
                                    echo "educ";
                                    break;
                                case "Bachelor of Science in Criminology":
                                    echo "crim";
                                    break;
                                case "Bachelor of Science in Civil Engineering":
                                    echo "cpe";
                                    break;
                                case "Bachelor of Science in Geodetic Engineering":
                                    echo "ge";
                                    break;
                            }

                        ?>" selected><?php echo $row['course'];?></option>
                         </select>
                   </div>
            </div>

             <div class="form-group row">
                     <div class="col-xs-4">
                        <label>Curriculum<span style="color:red;"> *</span></label>
                       <select name="curriculum" id="curriculum" class="form-control curriculumss" required>
                        <?php
                        include('data/config2.php');
                            $asd= mysqli_query($con,"select distinct curriculum from subject");
                            while($rows = mysqli_fetch_array($asd)):
                       ?>
                        <option value="<?php  if($rows['curriculum'] == $row['curriculum']) echo "selected"?>"><?php echo $rows['curriculum']; ?></option>
                        <?php endwhile; ?>
                         </select>
                   </div>
            </div>

          <label>Full Name<span style="color:red;"> *</span></label>
                <div class="form-group row">

                  <div class="col-xs-4">
                    <input type="text" class="form-control" name="fname" placeholder="firstname" value="<?php echo $row['fname']; ?>" />
                    </div>

                    <div class="col-xs-4">
                    <input type="text" class="form-control" name="lname" placeholder="lastname" value="<?php echo $row['lname']; ?>" />
                    </div>

                    <div class="col-xs-4">
                    <input type="text" class="form-control" name="mname" placeholder="middlename" value="<?php echo $row['mname']; ?>" />
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-xs-3">
                        <label>Citizenship<span style="color:red;"> *</span></label>
                <input type="text" class="form-control" name="citizen" placeholder="citizenship" value="<?php echo $row['citizenship'];?>" />
                    </div>

                    
                     <div class="col-xs-2">
                        <label>Civil Status</label>
                       <select name="status" class="form-control">
                        <option value="<?php echo $row['civil'];?>"><?php echo $row['civil'];?></option>
                        <option value="Single">Single</option>
                         <option value="Widowed">Widowed</option>
                         <option value="Married">Married</option>
                         </select>
                        </div>

                    <div class="col-xs-3">
                            <label>Religion</label>
                      <input type="text" class="form-control" name="religion" placeholder="religion" <?php echo $row['religion'];?> />
                    </div>

                     <div class="col-xs-2">
                        <label>Gender<span style="color:red;"> *</span></label>
                       <select name="gender" class="form-control">
                       <option value="<?php echo $row['gender'];?>"><?php echo $row['gender'];?></option>
                        <option value="Male">Male</option>
                         <option value="Female">Female</option>
                         </select>
                   </div>

                         <div class="col-xs-2">
                        <label>Birth Date<span style="color:red;"> *</span></label>
                      <input type="text" class="form-control" name="bday" placeholder="mm/dd/yyyy" value="<?php echo $row['bday'];?>" />
                   </div>

                </div>

             <div class="form-group row">

                  <div class="col-xs-5">
                    <label>Address<span style="color:red;"> *</span></label>
                    <input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo $row['address'];?>"/>
                    </div>

                    <div class="col-xs-3">
                    <label>Personal Number<span style="color:red;"> *</span></label>
                    <input type="text" class="form-control" name="pnumber" placeholder="Personal Number" value="<?php echo $row['contact'];?>" />
                    </div>

                </div>
        </div>
        <div class="modal-footer">
            <a href="studentlist.php"><button type="button" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button></a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
            </form>
            <?php endwhile; ?>
        </div>

    <?php    
    }
    
    function editteacher($teacher){ ?>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
            </li>
            <li>
                <a href="studentlist.php">Teacher's List</a>
            </li>
            <li class="active">
                Edit
            </li>
        </ol>
        <hr />
        <div class="modal-body">
            <?php while($row = mysqli_fetch_array($teacher)): ?>
            <form action="data/teacher_model.php?q=updateteacher&id=<?php echo $row['id'];?>" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="teachid" value="<?php echo $row['teachid']; ?>" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="fname" value="<?php echo $row['fname']; ?>" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="lname" value="<?php echo $row['lname']; ?>" />
                </div>
                 <div class="form-group">
                    <input type="text" class="form-control" name="mname" value="<?php echo $row['mname']; ?>" />
                </div>
        </div>
        <div class="modal-footer">
            <a href="teacherlist.php"><button type="button" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button></a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
            </form>
            <?php endwhile; ?>
        </div>

    <?php    
    }

    function editannounce($announce){ ?>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
            </li>
            <li>
                <a href="announcement.php">Announcements</a>
            </li>
            <li class="active">
                Edit
            </li>
        </ol>
        <hr />
        <div class="modal-body">
            <?php while($row = mysqli_fetch_array($announce)): ?>
            <form action="data/announce_model.php?q=updateannounce&id=<?php echo $row['id'];?>" method="post">
                 <div class="form-group">
                    <input type="text" class="form-control" name="atitle" value="<?php echo $row['announce_title']; ?>" />
                </div>
                <div class="form-group">
                  <textarea class="form-control" rows="8" name="ades"><?php echo $row['announce_des']; ?></textarea>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="date" value="<?php echo $row['date']; ?>" />
                </div>
        </div>
        <div class="modal-footer">
            <a href="announcement.php"><button type="button" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button></a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
            </form>
            <?php endwhile; ?>
        </div>

    <?php    
    }
}

?>