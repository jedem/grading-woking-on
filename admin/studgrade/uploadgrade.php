<!-- upload grades -->
<div class="modal fade" id="uploadgrade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Upload Grades</h3>
        </div>

        <div class="modal-body">
            <form action="data/subject_model.php?q=uploadgrade" method="post" enctype="multipart/form-data">

            <select name="class" class="form-control" required>
          <!-- upload grades 
		  <option value="noval">Select Class</option>
            <?php 
                $q = mysqli_query($con,"select * from school_year");
                $data = mysqli_fetch_array($q);
                $sch_year = $data['sch_year'];
                $sem = $data['sem'];
                $r = mysqli_query($con,"select * from class where teacher='$id' and sch_year='$sch_year' and sem='$sem'");
                while($row = mysqli_fetch_array($r)):
                if($row['status'] == 'active'){
            ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['subject']; ?> - <?php echo $row['section']; ?></option>
            <?php } else {
                
            }
            endwhile; ?>
            </select>
-->
            <br>
            <input type="file" name="filepath" id="filepath"/>
            <br>
            <input type="submit" class="btn btn-default" style="background-color:rgb(63,132,202);color:white;" name="SubmitButton"/>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>
        </div>
    </div>
  </div>
</div>

