<!-- ========================= STUDENT GRADE MODAL ======================= -->
<div id="addStudGradeModal" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Student Grade</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group" >
                        <label>School Year:</label>
                        <select name="ddl_sy" id="ddl_sy" data-style="btn-primary" class="form-control input-sm" onchange="show_class()">
                            <option selected disabled>-- Select School Year --</option>
                            <?php
                                $q = mysqli_query($con,"SELECT * from tblschoolyear");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['id'].'">'.$row['schoolyear'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Class:</label>
                        <select name="ddl_class" id="ddl_class" data-style="btn-primary" class="form-control input-sm" onchange="show_student()">
                            <option selected disabled>-- Select School Year First --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Subject:</label>
                        <select name="ddl_stud" id="ddl_stud" data-style="btn-primary" class="form-control input-sm" onchange="show_subj()">
                            <option selected disabled>-- Select Subject First --</option>
                        </select>
                    </div>
					<!-- ========================= STUDENT GRADE MODAL ======================= 
                    <div class="form-group">
                        <label>Subject:</label>
                        <select name="ddl_subj" id="ddl_subj" data-style="btn-primary" class="form-control input-sm" onchange="show_grade()">
                            <option selected disabled>-- Select Subject First --</option>
                        </select>
                    </div>-->
                    <div class="form-group" >
                        <label>Choose excel Scores file</label>
                        <input  class="form-control input-sm"   input type="file" name="filepath" id="filepath"       />
                    </div>
              
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add_studgrade" name="btn_add_studgrade" value="Add Student Grade"/>
        </div>
    </div>
  </div>
  </form>
</div>


<script>
    function show_class(){
        var syID = $('#ddl_sy').val();
        if(syID){
            $.ajax({
                type:'POST',
                url:'grade_dropdown.php',
                data: 'sy_id='+syID,
                success:function(html){
                    $('#ddl_class').html(html);
                }
            }); 
        }
    }

    function show_student(){
        var classID = $('#ddl_class').val();
        console.log(classID);
        if(classID){
            $.ajax({
                type:'POST',
                url:'grade_dropdown.php',
                data: 'class_id='+classID,
                success:function(html){
                    $('#ddl_stud').html(html);
                }
            }); 
        }
    }

    function show_subj(){
        var studID = $('#ddl_class').val();
        console.log(studID);
        if(studID){
            $.ajax({
                type:'POST',
                url:'grade_dropdown.php',
                data: 'stud_id='+studID,
                success:function(html){
                    $('#ddl_subj').html(html);
        console.log($('#ddl_subj').html(html));
                }
            }); 
        }
    }

    function show_grade(){
        var syID = $('#ddl_sy').val();
        var classID = $('#ddl_class').val();
        var studID = $('#ddl_class').val();
        var subjID = $('#ddl_subj').val();
        console.log(subjID);
        if(subjID){
            $.ajax({
                type:'POST',
                url:'grade_dropdown.php',
                data: 'sy1_id='+syID+'&subj1_id='+subjID+'&class1_id='+classID+'&stud1_id='+studID,
                success:function(html){
                    $('#grading1st').html(html);
					 $('#grading2nd').html(html);
					  $('#grading3rd').html(html);
					   $('#grading4th').html(html);
					    $('#grading5th').html(html);
						 $('#grading6th').html(html);
						  $('#grading7th').html(html);
						   $('#grading8th').html(html);
						   $('#grading9th').html(html);
						   $('#grading10th').html(html);
						  
					
                }
            }); 
        }
    }
</script>