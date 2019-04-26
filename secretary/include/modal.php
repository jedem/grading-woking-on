<!-- add modal for subject -->
<div class="modal fade" id="addsubject" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add Subject</h3>
        </div>
        <div class="modal-body">
            <form action="data/data_model.php?q=addsubject" method="post">
                   <div class="form-group row">
                      <div class="col-xs-4">
                        <label>Curriculum Year</label>
                        <input type="text" class="form-control" name="curriculum" id="curriculum" placeholder="Curriculum Year" required="" />
                        </div>

                        <div class="col-xs-4">
                        <label>Semester</label>
                        <select name="semester" id="semester" class="form-control"  required>
                        <option value="">Semester</option>
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                         <option value="Summer">Summer</option>
                        </select>
                        </div>


                        <div class="col-xs-4">
                        <label>Year Level</label>
                        <select name="yearlevel" id="yearlevel" class="form-control"  required>
                        <option value="">Year Level</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        </select>
                        </div>
                   </div>

                 <div class="form-group row">
                   <div class="col-xs-6">
                                 <label>College</label>
                       <select name="colleges" id="colleges" class="form-control"  required>
                        <option value="">College</option>
                        <option value="information">College of Information and Computing Science</option>
                        <option value="health">College of Health</option>
                        <option value="commerce">College of Commerce</option>
                        <option value="education">College of Education</option>
                        <option value="crim">College of Criminolgy</option>
                        <option value="engr">College of Engineering</option>
                         </select>
                   </div>
                   
                        <div class="col-xs-6">
                        <label>Course</label>
                       <select name="courses" id="courses" class="form-control"  required>
                        <option value="">Course</option>
                         </select>
                   </div>
                   </div>

                   <div class="form-group row">
                    <div class="col-xs-3">
                              <label>Subject Code</label>
                    <input type="text" class="form-control" name="code" placeholder="subject code" required="" />
                    </div>

                    <div class="col-xs-5">
                                         <label>Subject Title</label>
                    <input type="text" class="form-control" name="title" placeholder="subject title" required="" />
                    </div>

                    <div class="col-xs-2">
                        <label>No. of Units</label>
                    <input type="number" min="1" max="5" class="form-control" name="unit" placeholder='no. of units' required />
                    </div>

                    <div class="col-xs-5">
                                        <label>Prerequisite</label>
                    <input type="text" class="form-control" name="prereq" placeholder="prerequisite" />
                    </div>

                    <div class="col-xs-5">
                                          <label>Coreqruisite</label>
                    <input type="text" class="form-control" name="coreq" placeholder="corequisite" />
                    </div>
                   </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- acceptgrades-->
<div class="modal fade" id="acceptgrades" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

        <div class="modal-body">
            <form action="data/grade_model.php?q=acceptgrades" method="post">
                Are you sure you want to post this grade?
             <input type="hidden" name="classid" value="<?php echo $classids;?>">
            <input type="hidden" name="teacher" value="<?php echo $teachers;?>">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Yes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- enroll student -->
<div class="modal fade" id="enrollstudent" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Enroll Student</h3>
        </div>
        <div class="modal-body">
            <form action="data/data_model.php?q=enrollstudent" method="post">
            
                    <input type="hidden" name="id" value="<?php echo $classid;?>">
                    <select name="student" class="form-control" required>
                        <option value="">Select Student...</option>
                    <?php 
                    
                        $q = mysqli_query($con,"select * from studentsubject where classid=$classid");
                        while ($rows = mysqli_fetch_assoc($q)){
                            $stud[] = $rows['studid'];
                        }

                        $s = mysqli_query($con,"select * from student where id NOT IN('".implode("','",$stud)."')");
                        while($row = mysqli_fetch_array($s)):
                    ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['lname']; ?>, <?php echo $row['fname']; ?> <?php echo $row['mname']; ?></option>
                    <?php endwhile; ?>
                    </select>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- assign modal teacher -->
<div class="modal fade" id="assignteacher" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Assign Teacher</h3>
        </div>
        <div class="modal-body">
            <form action="data/data_model.php?q=assignteacher" method="post">
                    <input type="hidden" name="id" value="<?php echo $classid;?>">
                    <select name="teacher" class="form-control" required>
                        <option value="">Select Teacher...</option>
                    <?php 
                        $tid = $_GET['teachid'];
                        $r = mysqli_query($con,"select * from teacher where id!='$tid'");
                        while($row = mysqli_fetch_array($r)):
                    ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['lname']; ?>, <?php echo $row['fname']; ?> <?php echo $row['mname']; ?></option>
                    <?php endwhile; ?>
                    </select>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"> Assign</button>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- add modal for class info -->
<div class="modal fade" id="addclass" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add Class Info</h3>
        </div>
        <div class="modal-body">
            <form action="data/class_model.php?q=addclass" method="post">
                <div class="form-group">  

                    <div class="form-group">
                       <select name="colleges" id="colleges" class="form-control college"  required>
                        <option value="">College</option>
                        <option value="information">College of Information and Computing Science</option>
                        <option value="health">College of Health</option>
                        <option value="commerce">College of Commerce</option>
                        <option value="education">College of Education</option>
                        <option value="crim">College of Criminolgy</option>
                        <option value="engr">College of Engineering</option>
                         </select>
                    </div>


                    <div class="form-group">
                       <select name="course" id="courses" class="form-control course"  required>
                        <option value="">Course</option>
                         </select>
                    </div>
               

                    <select name="subject" class="form-control subject" required>

                    </select>

                </div>


                <div class="form-group">
                    <select name="year" class="form-control" required>
                        <option value="">Select Year...</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="section" class="form-control" required>
                        <option value="">Select Section...</option>
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                    </select>
                </div>

                <?php 
                $q3 = mysqli_query($con,"select * from school_year");
                $data = mysqli_fetch_array($q3);
                $semc = $data['sem'];
                $sch_yearc = $data['sch_year']; 
                ?>
                <div class="form-group">
                    <input type="text" name="sem" class="form-control" readonly value="<?php echo $semc; ?>">
                </div>
                
                <div class="form-group">
                <input type="text" name="sy" class="form-control" readonly value="<?php echo $sch_yearc; ?>">
                </div>

                <div class="form-group">
                <input type="text" name="time" placeholder="time" class="form-control" value="">
                </div>

                <div class="form-group">
                <input type="text" name="days" placeholder="days" class="form-control" value="">
                </div>

                <div class="form-group">
                <input type="text" name="room" placeholder="room" class="form-control" value="">
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- add modal for student -->
<div class="modal fade" id="addstudent" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa fa-user"></i> Add Student</h3>
        </div>
        <div class="modal-body">
        <h5><strong>Personal Information</strong></h5>
        <hr>
            <form action="data/student_model.php?q=addstudent" method="post">


                <div class="form-group row">
                    <div class="col-xs-4">
                            <label>Student ID<span style="color:red;"> *</span></label>
                        <input type="text" class="form-control" name="studid" placeholder="student ID"/>
                    </div>

                     <div class="col-xs-4">
                                 <label>College<span style="color:red;"> *</span></label>
                       <select name="colleges" id="colleges" class="form-control college collegelum"  required>
                        <option value="">College</option>
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
                       <select name="courses" id="courses" class="form-control course courselum"  required>
                        <option value="">Course</option>
                         </select>
                   </div>
            </div>  

             <div class="form-group row">
                     <div class="col-xs-4">
                        <label>Curriculum<span style="color:red;"> *</span></label>
                       <select name="curriculum" id="curriculum" class="form-control curriculumss" required>
                        <option value="">Curriculum</option>
                        <?php
                            $scurri = mysqli_query($con,"select distinct curriculum from subject");
                            while($row = mysqli_fetch_array($scurri)):
                       ?>
                        <option value="<?php echo $row['curriculum']; ?>"><?php echo $row['curriculum']; ?></option>
                        <?php endwhile; ?>
                         </select>
                   </div>
            </div>

          <label>Full Name<span style="color:red;"> *</span></label>
                <div class="form-group row">

                  <div class="col-xs-4">
                    <input type="text" class="form-control" name="fname" placeholder="firstname" required />
                    </div>

                    <div class="col-xs-4">
                    <input type="text" class="form-control" name="lname" placeholder="lastname" required />
                    </div>

                    <div class="col-xs-4">
                    <input type="text" class="form-control" name="mname" placeholder="middlename" required />
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-xs-3">
                        <label>Citizenship<span style="color:red;"> *</span></label>
                <input type="text" class="form-control" name="citizen" placeholder="citizenship" required />
                    </div>

                    
                     <div class="col-xs-2">
                        <label>Civil Status</label>
                       <select name="status" class="form-control">
                        <option value="single">Single</option>
                         <option value="widowed">Widowed</option>
                         <option value="married">Married</option>
                         </select>
                        </div>

                    <div class="col-xs-3">
                            <label>Religion</label>
                      <input type="text" class="form-control" name="religion" placeholder="religion" />
                    </div>

                     <div class="col-xs-2">
                        <label>Gender<span style="color:red;"> *</span></label>
                       <select name="gender" class="form-control"  required>
                        <option value="male">Male</option>
                         <option value="female">Female</option>
                         </select>
                   </div>

                         <div class="col-xs-2">
                        <label>Birth Date<span style="color:red;"> *</span></label>
                      <input type="text" class="form-control" name="bday" placeholder="mm/dd/yyyy" required />
                   </div>

                </div>

             <div class="form-group row">

                  <div class="col-xs-5">
                    <label>Address<span style="color:red;"> *</span></label>
                    <input type="text" class="form-control" name="address" placeholder="Address" required />
                    </div>

                    <div class="col-xs-3">
                    <label>Personal Number<span style="color:red;"> *</span></label>
                    <input type="text" class="form-control" name="pnumber" placeholder="Personal Number" required />
                    </div>

                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- add modal for announcement -->
<div class="modal fade" id="addannounce" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa fa-user"></i> Add Announcement</h3>
        </div>
        <div class="modal-body">
            <form action="data/announce_model.php?q=addannounce" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="atitle" placeholder="Announcement Title" />
                </div>
                <div class="form-group">
                  <textarea class="form-control" rows="8" name="ades" placeholder="Announcement Description"></textarea>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="date" readonly placeholder="Date Posted" value="<?php echo date('F j, Y');?>" />
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- add modal for student -->
<div class="modal fade" id="addteacher" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa fa-user"></i> Add Teacher</h3>
        </div>
        <div class="modal-body">
            <form action="data/teacher_model.php?q=addteacher" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="teachid" placeholder="teacher ID" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="fname" placeholder="firstname" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="lname" placeholder="lastname" />
                </div>
                 <div class="form-group">
                    <input type="text" class="form-control" name="mname" placeholder="middlename" />
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- add user -->
<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add User</h3>
        </div>
        <div class="modal-body">
            <form action="data/settings_model.php?q=adduser" method="post">
                <div class="form-group">  
                <div class="form-group">
                    <input type="text" name="username" class="form-control"  placeholder="username" value="" required="">
                </div>
                
                <div class="form-group">
                    <input type="text" name="password" class="form-control" placeholder="password"  value="" required=""> 
                </div>

                <div class="form-group">
                <input type="text" name="fname" class="form-control" placeholder="firstname"  value="" required="">
                </div>

                <div class="form-group">
                <input type="text" name="lname" class="form-control" placeholder="lastname"  value="" required="">
                </div>

                <div class="form-group">
                <select name="level" class="form-control" required="">
                    <option value="">Select Level</option>
                    <option value="admin">Admin</option>
                    <option value="secretary">Secretary</option>
                    <option value="student">student</option>
                </select>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>
