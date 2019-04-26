<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'grading';

    $con = mysqli_connect($host,$user,$pass,$db) or die(mysqli_error());

  if(isset($_POST['loadsearchtext'])){
      $search = $_POST['search'];
      $output = '<div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Curriculum</th>
                                <th class="text-center">College</th>
                                <th>Subject Code</th>
                                <th>Subject Title</th>
                                <th class="text-center">Units</th>
                                <th class="text-center">Prerequisite</th>
                                <th class="text-center">Corerequisite</th>
                                 <th class="text-center">Remove</th>
                            </tr>
                        </thead>
                        <tbody>';
      $q = "select * from subject where code like '%$search%' or title like '%$search%' or curriculum like '%$search%' or college like '%$search%' or unit like '%$search%' order by code asc";
      $r = mysqli_query($con,$q);
      $c = 1;

      while($row = mysqli_fetch_array($r))
      {
        $output .= '<tr>
                    <td class="text-center">'.$c.'</td>
                    <td class="text-center">'.$row['curriculum'].'</td>
                    <td class="text-center">'.$row['college'].'</td>
                    <td class="text-center"><a href="edit.php?type=subject&id='.$row['id'].'">'.$row['code'].'</a></td>
                    <td class="text-center">'.$row['title'].'</td>
                    <td class="text-center">'.$row['unit'].'</td>
                    <td class="text-center">'.$row['prereq'].'</td>
                    <td class="text-center">'.$row['corequisite'].'</td>
                    <td class="text-center"><a href="data/data_model.php?q=delete&table=subject&id='.$row['id'].'"><i class="fa fa-times-circle fa-lg text-danger confirmation"></i></a></td>
                    </tr>';
                    $c++;
      }
      if(mysqli_num_rows($r) < 1)
      {
        $output .= '    <tr>
                                    <td colspan="4" class="bg-danger text-danger text-center">*** EMPTY ***</td>
                        </tr>
                                    </tbody>
                    </table>
                </div>';
      }

      echo $output;

  }
  if(isset($_POST['loadallsubjects']))
  {
         $output = '<div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Curriculum</th>
                                        <th class="text-center">College</th>
                                        <th>Subject Code</th>
                                        <th>Subject Title</th>
                                        <th class="text-center">Units</th>
                                        <th class="text-center">Prerequisite</th>
                                        <th class="text-center">Corerequisite</th>
                                         <th class="text-center">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>';
              $q = "select * from subject";
              $r = mysqli_query($con,$q);
              $c = 1;

              while($row = mysqli_fetch_array($r))
              {
                $output .= '<tr>
                            <td class="text-center">'.$c.'</td>
                            <td class="text-center">'.$row['curriculum'].'</td>
                            <td class="text-center">'.$row['college'].'</td>
                            <td class="text-center"><a href="edit.php?type=subject&id='.$row['id'].'">'.$row['code'].'</a></td>
                            <td class="text-center">'.$row['title'].'</td>
                            <td class="text-center">'.$row['unit'].'</td>
                            <td class="text-center">'.$row['prereq'].'</td>
                            <td class="text-center">'.$row['corequisite'].'</td>
                            <td class="text-center"><a href="data/data_model.php?q=delete&table=subject&id='.$row['id'].'"><i class="fa fa-times-circle fa-lg text-danger confirmation"></i></a></td>
                            </tr>';
                            $c++;
              }
              if(mysqli_num_rows($r) < 1)
              {
                $output .= '    <tr class="text-center">
                                            <td colspan="4" class="bg-danger text-danger text-center">*** EMPTY ***</td>
                                </tr>
                                            </tbody>
                            </table>
                        </div>';
              }

              echo $output;
  }
  if(isset($_POST['loadsearchcurriculum']))
  {
         $college = $_POST['college'];
         $course = $_POST['course'];
         $curriculum = $_POST['curriculum'];


            switch ($college) {
                case "information":
                    $college = "College of Information and Computing Science";
                    break;
                case "health":
                    $college = "College of Health";
                    break;
                case "commerce":
                    $college = "College of Commerce";
                    break;
                case "education":
                    $college = "College of Education";
                    break;
                case "crim":
                    $college = "College of Criminolgy";
                    break;
                case "engr":
                    $college = "College of Engineering";
                    break;
            }

            switch ($course) {
                case "cs":
                    $course = "Bachelor of Science in Computer Science";
                    break;
                case "it":
                    $course = "Bachelor of Science in Information Technology";
                    break;
                case "ce":
                    $course = "Bachelor of Science in Computer Engineering";
                    break;
                case "nurse":
                    $course = "Bachelor of Science in Nursing";
                    break;
                case "midwife":
                    $course = "Bachelor of Science in Midwife";
                    break;  
                case "midwirey":
                    $course = "Diploma in Midwirey";
                    break;   
                case "account":
                    $course = "Bachelor of Science in Accountancy";
                    break;    
                case "ba":
                    $course = "Bachelor of Science in Business Administration";
                    break;
                case "hrm":
                    $course = "Bachelor of Science in HRM";
                    break;
                case "se":
                    $course = "Bachelor of Science in Secondary Education";
                    break;
                case "educ":
                    $course = "Bachelor of Elementary Education";
                    break;
                case "crim":
                    $course = "Bachelor of Science in Criminology";
                    break;
                case "cpe":
                    $course = "Bachelor of Science in Civil Engineering";
                    break;
                case "ge":
                    $course = "Bachelor of Science in Geodetic Engineering";
                    break;
            }

            $firstquery = "SELECT * from subject WHERE college='$college' AND course='$course' AND curriculum='$curriculum' AND semester='1st' AND year='1'";
            $firstresult = mysqli_query($con,$firstquery);
            $hasFoundAtLeastOneRow = false;
            $firstRow = true;
            $output = '';
            while($row = mysqli_fetch_array($firstresult))
            {
              if($firstRow){
               $output .='<h5><strong>'.$row['college'].'</strong></h5>
                                         <h5><strong>'.$row['course'].'</strong></h5>
                                         <h5><strong>Curriculum Year : '.$row['curriculum'].'</strong></h5>
                                         <br>
                                         <h5><strong>1<sup>st</sup> Semester - 1<sup>st</sup> Year</strong></h5>
                                         <br>
                                        <div class="table-responsive">
                                       <table class="table table-striped">
                                        <thead>
                                          <tr>
                                              <th class="text-center">Subject Code</th>
                                              <th class="text-center">Subject Title</th>
                                              <th class="text-center">Units</th>
                                              <th class="text-center">Pre-req</th>
                                              <th class="text-center">Co-req</th>
                                          </tr>
                                      </thead>
                                  <tbody>';
                }
                 $output .= '<tr>
                                    <td class="text-center">'.$row['code'].'</td>
                                    <td class="text-center">'.$row['title'].'</td>
                                    <td class="text-center">'.$row['unit'].'</td>
                                    <td class="text-center">'.$row['prereq'].'</td>
                                    <td class="text-center">'.$row['corequisite'].'</td>
                                 </tr>';
                $hasFoundAtLeastOneRow = true;   
                $firstRow = false;  
              }
              if($hasFoundAtLeastOneRow) {
                    $output .= '</tbody>
                              </table>
                            </div>';
              }

               $secondquery = "SELECT * from subject WHERE college='$college' AND course='$course' AND curriculum='$curriculum' AND semester='2nd' AND year='1'";
                $secondresult = mysqli_query($con,$secondquery);
                $hasFoundAtLeastOneRow2nd  = false;
                $firstRow2nd  = true;
                while($row = mysqli_fetch_array($secondresult))
                {
                  if($firstRow2nd){
                   $output .='<h5><strong>2<sup>nd</sup> Semester - 1<sup>st</sup> Year</strong></h5>
                                             <br>
                                            <div class="table-responsive">
                                           <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                  <th class="text-center">Subject Code</th>
                                                  <th class="text-center">Subject Title</th>
                                                  <th class="text-center">Units</th>
                                                  <th class="text-center">Pre-req</th>
                                                  <th class="text-center">Co-req</th>
                                              </tr>
                                          </thead>
                                      <tbody>';
                    }
                     $output .= '<tr>
                                        <td class="text-center">'.$row['code'].'</td>
                                        <td class="text-center">'.$row['title'].'</td>
                                        <td class="text-center">'.$row['unit'].'</td>
                                        <td class="text-center">'.$row['prereq'].'</td>
                                        <td class="text-center">'.$row['corequisite'].'</td>
                                     </tr>';
                    $hasFoundAtLeastOneRow2nd = true;   
                    $firstRow2nd = false;  
                  }
                  if($hasFoundAtLeastOneRow2nd) {
                        $output .= '</tbody>
                                  </table>
                                </div>';
                  }

                $thirdquery = "SELECT * from subject WHERE college='$college' AND course='$course' AND curriculum='$curriculum' AND semester='Summer' AND year='1'";
                $thirdresult = mysqli_query($con,$thirdquery);
                $hasFoundAtLeastOneRow1stsummer   = false;
                $firstRow1stsummer   = true;
                while($row = mysqli_fetch_array($thirdresult))
                {
                  if($firstRow1stsummer){
                   $output .='<h5><strong>Summer - 1<sup>st</sup> Year</strong></h5>
                                             <br>
                                            <div class="table-responsive">
                                           <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                  <th class="text-center">Subject Code</th>
                                                  <th class="text-center">Subject Title</th>
                                                  <th class="text-center">Units</th>
                                                  <th class="text-center">Pre-req</th>
                                                  <th class="text-center">Co-req</th>
                                              </tr>
                                          </thead>
                                      <tbody>';
                    }
                     $output .= '<tr>
                                        <td class="text-center">'.$row['code'].'</td>
                                        <td class="text-center">'.$row['title'].'</td>
                                        <td class="text-center">'.$row['unit'].'</td>
                                        <td class="text-center">'.$row['prereq'].'</td>
                                        <td class="text-center">'.$row['corequisite'].'</td>
                                     </tr>';
                    $hasFoundAtLeastOneRow1stsummer = true;   
                    $firstRow1stsummer = false;  
                  }
                  if($hasFoundAtLeastOneRow1stsummer) {
                        $output .= '</tbody>
                                  </table>
                                </div>';
                  }


                $fourthquery = "SELECT * from subject WHERE college='$college' AND course='$course' AND curriculum='$curriculum' AND semester='1st' AND year='2'";
                $fourthresult = mysqli_query($con,$fourthquery);
                $hasFoundAtLeastOneRow2nd1st    = false;
                $firstRow2nd1st    = true;
                while($row = mysqli_fetch_array($fourthresult))
                {
                  if($firstRow2nd1st){
                          $output .='<h5><strong>1<sup>st</sup> Semester - 2<sup>nd</sup> Year</strong></h5>
                                             <br>
                                            <div class="table-responsive">
                                           <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                  <th class="text-center">Subject Code</th>
                                                  <th class="text-center">Subject Title</th>
                                                  <th class="text-center">Units</th>
                                                  <th class="text-center">Pre-req</th>
                                                  <th class="text-center">Co-req</th>
                                              </tr>
                                          </thead>
                                      <tbody>';
                    }
                     $output .= '<tr>
                                        <td class="text-center">'.$row['code'].'</td>
                                        <td class="text-center">'.$row['title'].'</td>
                                        <td class="text-center">'.$row['unit'].'</td>
                                        <td class="text-center">'.$row['prereq'].'</td>
                                        <td class="text-center">'.$row['corequisite'].'</td>
                                     </tr>';
                    $hasFoundAtLeastOneRow2nd1st = true;   
                    $firstRow2nd1st = false;  
                  }
                  if($hasFoundAtLeastOneRow2nd1st) {
                        $output .= '</tbody>
                                  </table>
                                </div>';
                  }



                $fifthquery = "SELECT * from subject WHERE college='$college' AND course='$course' AND curriculum='$curriculum' AND semester='2nd' AND year='2'";
                $fifthresult = mysqli_query($con,$fifthquery);
                $hasFoundAtLeastOneRow2nd2nd = false;
                $firstRow2nd2nd = true;
                while($row = mysqli_fetch_array($fifthresult))
                {
                  if($firstRow2nd2nd){
                          $output .='<h5><strong>2<sup>nd</sup> Semester - 2<sup>nd</sup> Year</strong></h5>
                                             <br>
                                            <div class="table-responsive">
                                           <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                  <th class="text-center">Subject Code</th>
                                                  <th class="text-center">Subject Title</th>
                                                  <th class="text-center">Units</th>
                                                  <th class="text-center">Pre-req</th>
                                                  <th class="text-center">Co-req</th>
                                              </tr>
                                          </thead>
                                      <tbody>';
                    }
                     $output .= '<tr>
                                        <td class="text-center">'.$row['code'].'</td>
                                        <td class="text-center">'.$row['title'].'</td>
                                        <td class="text-center">'.$row['unit'].'</td>
                                        <td class="text-center">'.$row['prereq'].'</td>
                                        <td class="text-center">'.$row['corequisite'].'</td>
                                     </tr>';
                    $hasFoundAtLeastOneRow2nd2nd = true;   
                    $firstRow2nd2nd = false;  
                  }
                  if($hasFoundAtLeastOneRow2nd2nd) {
                        $output .= '</tbody>
                                  </table>
                                </div>';
                  }


                $sixquery = "SELECT * from subject WHERE college='$college' AND course='$course' AND curriculum='$curriculum' AND semester='Summer' AND year='2'";
                $sixresult = mysqli_query($con,$sixquery);
                $hasFoundAtLeastOneRow2ndsummer    = false;
                $firstRow2ndsummer    = true;
                while($row = mysqli_fetch_array($sixresult))
                {
                  if($firstRow2ndsummer){
                   $output .='<h5><strong>Summer - 2<sup>nd</sup> Year</strong></h5>
                                             <br>
                                            <div class="table-responsive">
                                           <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                  <th class="text-center">Subject Code</th>
                                                  <th class="text-center">Subject Title</th>
                                                  <th class="text-center">Units</th>
                                                  <th class="text-center">Pre-req</th>
                                                  <th class="text-center">Co-req</th>
                                              </tr>
                                          </thead>
                                      <tbody>';
                    }
                     $output .= '<tr>
                                        <td class="text-center">'.$row['code'].'</td>
                                        <td class="text-center">'.$row['title'].'</td>
                                        <td class="text-center">'.$row['unit'].'</td>
                                        <td class="text-center">'.$row['prereq'].'</td>
                                        <td class="text-center">'.$row['corequisite'].'</td>
                                     </tr>';
                    $hasFoundAtLeastOneRow2ndsummer = true;   
                    $firstRow2ndsummer = false;  
                  }
                  if($hasFoundAtLeastOneRow2ndsummer) {
                        $output .= '</tbody>
                                  </table>
                                </div>';
                  }

                $sevenquery = "SELECT * from subject WHERE college='$college' AND course='$course' AND curriculum='$curriculum' AND semester='1st' AND year='3'";
                $sevenresult = mysqli_query($con,$sevenquery);
                $hasFoundAtLeastOneRow1st3rd     = false;
                $firstRow1st3rd     = true;
                while($row = mysqli_fetch_array($sevenresult))
                {
                  if($firstRow1st3rd){
                          $output .='<h5><strong>1<sup>st</sup> Semester - 3<sup>rd</sup> Year</strong></h5>
                                             <br>
                                            <div class="table-responsive">
                                           <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                  <th class="text-center">Subject Code</th>
                                                  <th class="text-center">Subject Title</th>
                                                  <th class="text-center">Units</th>
                                                  <th class="text-center">Pre-req</th>
                                                  <th class="text-center">Co-req</th>
                                              </tr>
                                          </thead>
                                      <tbody>';
                    }
                     $output .= '<tr>
                                        <td class="text-center">'.$row['code'].'</td>
                                        <td class="text-center">'.$row['title'].'</td>
                                        <td class="text-center">'.$row['unit'].'</td>
                                        <td class="text-center">'.$row['prereq'].'</td>
                                        <td class="text-center">'.$row['corequisite'].'</td>
                                     </tr>';
                    $hasFoundAtLeastOneRow1st3rd = true;   
                    $firstRow1st3rd = false;  
                  }
                  if($hasFoundAtLeastOneRow1st3rd) {
                        $output .= '</tbody>
                                  </table>
                                </div>';
                  }


                $eightquery = "SELECT * from subject WHERE college='$college' AND course='$course' AND curriculum='$curriculum' AND semester='2nd' AND year='3'";
                $eightresult = mysqli_query($con,$eightquery);
                $hasFoundAtLeastOneRow2nd3rd      = false;
                $firstRow2nd3rd      = true;
                while($row = mysqli_fetch_array($eightresult))
                {
                  if($firstRow2nd3rd){
                          $output .='<h5><strong>2<sup>nd</sup> Semester - 3<sup>rd</sup> Year</strong></h5>
                                             <br>
                                            <div class="table-responsive">
                                           <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                  <th class="text-center">Subject Code</th>
                                                  <th class="text-center">Subject Title</th>
                                                  <th class="text-center">Units</th>
                                                  <th class="text-center">Pre-req</th>
                                                  <th class="text-center">Co-req</th>
                                              </tr>
                                          </thead>
                                      <tbody>';
                    }
                     $output .= '<tr>
                                        <td class="text-center">'.$row['code'].'</td>
                                        <td class="text-center">'.$row['title'].'</td>
                                        <td class="text-center">'.$row['unit'].'</td>
                                        <td class="text-center">'.$row['prereq'].'</td>
                                        <td class="text-center">'.$row['corequisite'].'</td>
                                     </tr>';
                    $hasFoundAtLeastOneRow2nd3rd = true;   
                    $firstRow2nd3rd = false;  
                  }
                  if($hasFoundAtLeastOneRow2nd3rd) {
                        $output .= '</tbody>
                                  </table>
                                </div>';
                  }

                $ninequery = "SELECT * from subject WHERE college='$college' AND course='$course' AND curriculum='$curriculum' AND semester='Summer' AND year='3'";
                $nineresult = mysqli_query($con,$ninequery);
                $hasFoundAtLeastOneRow3rdsummer     = false;
                $firstRow3rdsummer     = true;
                while($row = mysqli_fetch_array($nineresult))
                {
                  if($firstRow3rdsummer){
                   $output .='<h5><strong>Summer - 3<sup>rd</sup> Year</strong></h5>
                                             <br>
                                            <div class="table-responsive">
                                           <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                  <th class="text-center">Subject Code</th>
                                                  <th class="text-center">Subject Title</th>
                                                  <th class="text-center">Units</th>
                                                  <th class="text-center">Pre-req</th>
                                                  <th class="text-center">Co-req</th>
                                              </tr>
                                          </thead>
                                      <tbody>';
                    }
                     $output .= '<tr>
                                        <td class="text-center">'.$row['code'].'</td>
                                        <td class="text-center">'.$row['title'].'</td>
                                        <td class="text-center">'.$row['unit'].'</td>
                                        <td class="text-center">'.$row['prereq'].'</td>
                                        <td class="text-center">'.$row['corequisite'].'</td>
                                     </tr>';
                    $hasFoundAtLeastOneRow3rdsummer = true;   
                    $firstRow3rdsummer = false;  
                  }
                  if($hasFoundAtLeastOneRow3rdsummer) {
                        $output .= '</tbody>
                                  </table>
                                </div>';
                  }

                $tenquery = "SELECT * from subject WHERE college='$college' AND course='$course' AND curriculum='$curriculum' AND semester='1st' AND year='4'";
                $tenresult = mysqli_query($con,$tenquery);
                $hasFoundAtLeastOneRow1st4th      = false;
                $firstRow1st4th      = true;
                while($row = mysqli_fetch_array($tenresult))
                {
                  if($firstRow1st4th){
                          $output .='<h5><strong>1<sup>st</sup> Semester - 4<sup>th</sup> Year</strong></h5>
                                             <br>
                                            <div class="table-responsive">
                                           <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                  <th class="text-center">Subject Code</th>
                                                  <th class="text-center">Subject Title</th>
                                                  <th class="text-center">Units</th>
                                                  <th class="text-center">Pre-req</th>
                                                  <th class="text-center">Co-req</th>
                                              </tr>
                                          </thead>
                                      <tbody>';
                    }
                     $output .= '<tr>
                                        <td class="text-center">'.$row['code'].'</td>
                                        <td class="text-center">'.$row['title'].'</td>
                                        <td class="text-center">'.$row['unit'].'</td>
                                        <td class="text-center">'.$row['prereq'].'</td>
                                        <td class="text-center">'.$row['corequisite'].'</td>
                                     </tr>';
                    $hasFoundAtLeastOneRow1st4th = true;   
                    $firstRow1st4th = false;  
                  }
                  if($hasFoundAtLeastOneRow1st4th) {
                        $output .= '</tbody>
                                  </table>
                                </div>';
                  }

                $elevenquery = "SELECT * from subject WHERE college='$college' AND course='$course' AND curriculum='$curriculum' AND semester='2nd' AND year='4'";
                $elevenresult = mysqli_query($con,$elevenquery);
                $hasFoundAtLeastOneRow2nd4th       = false;
                $firstRow2nd4th       = true;
                while($row = mysqli_fetch_array($elevenresult))
                {
                  if($firstRow2nd4th){
                          $output .='<h5><strong>2<sup>nd</sup> Semester - 4<sup>th</sup> Year</strong></h5>
                                             <br>
                                            <div class="table-responsive">
                                           <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                  <th class="text-center">Subject Code</th>
                                                  <th class="text-center">Subject Title</th>
                                                  <th class="text-center">Units</th>
                                                  <th class="text-center">Pre-req</th>
                                                  <th class="text-center">Co-req</th>
                                              </tr>
                                          </thead>
                                      <tbody>';
                    }
                     $output .= '<tr>
                                        <td class="text-center">'.$row['code'].'</td>
                                        <td class="text-center">'.$row['title'].'</td>
                                        <td class="text-center">'.$row['unit'].'</td>
                                        <td class="text-center">'.$row['prereq'].'</td>
                                        <td class="text-center">'.$row['corequisite'].'</td>
                                     </tr>';
                    $hasFoundAtLeastOneRow2nd4th = true;   
                    $firstRow2nd4th = false;  
                  }
                  if($hasFoundAtLeastOneRow2nd4th) {
                        $output .= '</tbody>
                                  </table>
                                </div>';
                  }

                $twelvequery = "SELECT * from subject WHERE college='$college' AND course='$course' AND curriculum='$curriculum' AND semester='Summer' AND year='4'";
                $twelveresult = mysqli_query($con,$twelvequery);
                $hasFoundAtLeastOneRow4thsummer      = false;
                $firstRow4thsummer      = true;
                while($row = mysqli_fetch_array($twelveresult))
                {
                  if($firstRow4thsummer){
                   $output .='<h5><strong>Summer - 4<sup>th</sup> Year</strong></h5>
                                             <br>
                                            <div class="table-responsive">
                                           <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                  <th class="text-center">Subject Code</th>
                                                  <th class="text-center">Subject Title</th>
                                                  <th class="text-center">Units</th>
                                                  <th class="text-center">Pre-req</th>
                                                  <th class="text-center">Co-req</th>
                                              </tr>
                                          </thead>
                                      <tbody>';
                    }
                     $output .= '<tr>
                                        <td class="text-center">'.$row['code'].'</td>
                                        <td class="text-center">'.$row['title'].'</td>
                                        <td class="text-center">'.$row['unit'].'</td>
                                        <td class="text-center">'.$row['prereq'].'</td>
                                        <td class="text-center">'.$row['corequisite'].'</td>
                                     </tr>';
                    $hasFoundAtLeastOneRow4thsummer = true;   
                    $firstRow4thsummer = false;  
                  }
                  if($hasFoundAtLeastOneRow4thsummer) {
                        $output .= '</tbody>
                                  </table>
                                </div>';
                  }

                $thirteenquery = "SELECT * from subject WHERE college='$college' AND course='$course' AND curriculum='$curriculum' AND semester='1st' AND year='5'";
                $thirteenresult = mysqli_query($con,$thirteenquery);
                $hasFoundAtLeastOneRow1st5th       = false;
                $firstRow1st5th       = true;
                while($row = mysqli_fetch_array($thirteenresult))
                {
                  if($firstRow1st5th){
                          $output .='<h5><strong>1<sup>st</sup> Semester - 5<sup>th</sup> Year</strong></h5>
                                             <br>
                                            <div class="table-responsive">
                                           <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                  <th class="text-center">Subject Code</th>
                                                  <th class="text-center">Subject Title</th>
                                                  <th class="text-center">Units</th>
                                                  <th class="text-center">Pre-req</th>
                                                  <th class="text-center">Co-req</th>
                                              </tr>
                                          </thead>
                                      <tbody>';
                    }
                     $output .= '<tr>
                                        <td class="text-center">'.$row['code'].'</td>
                                        <td class="text-center">'.$row['title'].'</td>
                                        <td class="text-center">'.$row['unit'].'</td>
                                        <td class="text-center">'.$row['prereq'].'</td>
                                        <td class="text-center">'.$row['corequisite'].'</td>
                                     </tr>';
                    $hasFoundAtLeastOneRow1st5th = true;   
                    $firstRow1st5th = false;  
                  }
                  if($hasFoundAtLeastOneRow1st5th) {
                        $output .= '</tbody>
                                  </table>
                                </div>';
                  }

                $fourteenquery = "SELECT * from subject WHERE college='$college' AND course='$course' AND curriculum='$curriculum' AND semester='2nd' AND year='5'";
                $fourteenresult = mysqli_query($con,$fourteenquery);
                $hasFoundAtLeastOneRow2nd5th        = false;
                $firstRow2nd5th        = true;
                while($row = mysqli_fetch_array($fourteenresult))
                {
                  if($firstRow2nd5th){
                          $output .='<h5><strong>2<sup>nd</sup> Semester - 5<sup>th</sup> Year</strong></h5>
                                             <br>
                                            <div class="table-responsive">
                                           <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                  <th class="text-center">Subject Code</th>
                                                  <th class="text-center">Subject Title</th>
                                                  <th class="text-center">Units</th>
                                                  <th class="text-center">Pre-req</th>
                                                  <th class="text-center">Co-req</th>
                                              </tr>
                                          </thead>
                                      <tbody>';
                    }
                     $output .= '<tr>
                                        <td class="text-center">'.$row['code'].'</td>
                                        <td class="text-center">'.$row['title'].'</td>
                                        <td class="text-center">'.$row['unit'].'</td>
                                        <td class="text-center">'.$row['prereq'].'</td>
                                        <td class="text-center">'.$row['corequisite'].'</td>
                                     </tr>';
                    $hasFoundAtLeastOneRow2nd5th = true;   
                    $firstRow2nd5th = false;  
                  }
                  if($hasFoundAtLeastOneRow2nd5th) {
                        $output .= '</tbody>
                                  </table>
                                </div>';
                  }

                $fifteenquery = "SELECT * from subject WHERE college='$college' AND course='$course' AND curriculum='$curriculum' AND semester='Summer' AND year='5'";
                $fifteenresult = mysqli_query($con,$fifteenquery);
                $hasFoundAtLeastOneRow5thsummer       = false;
                $firstRow5thsummer       = true;
                while($row = mysqli_fetch_array($fifteenresult))
                {
                  if($firstRow5thsummer){
                   $output .='<h5><strong>Summer - 5<sup>th</sup> Year</strong></h5>
                                             <br>
                                            <div class="table-responsive">
                                           <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                  <th class="text-center">Subject Code</th>
                                                  <th class="text-center">Subject Title</th>
                                                  <th class="text-center">Units</th>
                                                  <th class="text-center">Pre-req</th>
                                                  <th class="text-center">Co-req</th>
                                              </tr>
                                          </thead>
                                      <tbody>';
                    }
                     $output .= '<tr>
                                        <td class="text-center">'.$row['code'].'</td>
                                        <td class="text-center">'.$row['title'].'</td>
                                        <td class="text-center">'.$row['unit'].'</td>
                                        <td class="text-center">'.$row['prereq'].'</td>
                                        <td class="text-center">'.$row['corequisite'].'</td>
                                     </tr>';
                    $hasFoundAtLeastOneRow5thsummer = true;   
                    $firstRow5thsummer = false;  
                  }
                  if($hasFoundAtLeastOneRow5thsummer) {
                        $output .= '</tbody>
                                  </table>
                                </div>';
                  }


      echo $output;       

  }

 if(isset($_POST['loadnotif'])){

          $description = "Submitted a grade on";
          $output = ' <ul id="main-menu" class="nav navbar-nav navbar-right">
                   <li class="dropdown hidden-xs">
                    <li id="notification_li">';

                 $sql ="SELECT * FROM notification WHERE notif_description='$description'
 AND status='unread' ORDER BY `date` DESC";
                $result = mysqli_query($con, $sql);
                $count = mysqli_num_rows($result);

            if($count == 0){
               $output .= '<a href="#" id="notificationLink onclick="loadglobe()"><i class="fa fa-bell" style="color:white;"></i>
                <span id="notification_count" style="padding:0 !important;"></span></a>';
            }
            else{ 
                 $output .= '<a href="#" id="notificationLink" onclick="loadglobe()"><i class="fa fa-bell" style="color:white;"></i>
                <span id="notification_count">'.$count.'</span></a>';
            }


            $output .='<div id="notificationContainer">
                <div id="notificationTitle">Notifications</div>
                <div id="notificationsBody" class="notifications">';

                 $sql2 ="SELECT * FROM notification WHERE notif_description='$description' ORDER BY `date` DESC";
                $result2 = mysqli_query($con, $sql2);

            while($row = mysqli_fetch_array($result2))
            {
            $teachid = $row['teachid'];
            $getfacultyname = "SELECT * FROM teacher WHERE teachid='$teachid'";
            $resultfaculty = mysqli_query($con, $getfacultyname);
            $rowfacname = mysqli_fetch_array($resultfaculty);

           $output .='       <a href="grades.php" style="text-decoration:none;display:block;color:black;background-color:#EDF2FA;margin-bottom:-5px" id="notifa">
                          <div>
                    <img src="../img/prof.jpg" style="max-width:50px;max-height:70px;float:left;margin:5px 10px;">
                             <p style="display:inline;"><strong>'.ucwords(strtolower($rowfacname['fname'])).' '.ucwords(strtolower($rowfacname['lname'])).'</strong> '.$row['notif_description'].'<strong><br> '.ucwords(strtolower($row['subj_description'])).'</strong></p>
                             <p style="font-size:12px;">'.$row['date'].'</p>
                             
                          </div>
                        
                        </a>';
            }


        $output .='</div>
        <div id="notificationFooter"><a href="#">See All</a></div>
                </div>
            </li>
            </li>
            </ul>';


          echo $output;

   }

    if(isset($_POST['loadnotifs'])){
      $output = '';
             $description = "Submitted a grade on";
                 $sql ="SELECT * FROM notification WHERE notif_description='$description'";
                $result = mysqli_query($con, $sql);
                $count = mysqli_num_rows($result);
                       
            while($row = mysqli_fetch_array($result))
            {
            $teachid = $row['teachid'];
            $getfacultyname = "SELECT * FROM teacher WHERE teachid='$teachid'";
            $resultfaculty = mysqli_query($con, $getfacultyname);
            $rowfacname = mysqli_fetch_array($resultfaculty);

           $output .='       <a href="grades.php" style="text-decoration:none;display:block;color:black;background-color:#EDF2FA;margin-bottom:-5px" id="notifa">
                          <div>
   <img src="../img/prof.jpg" style="max-width:50px;max-height:70px;float:left;margin:5px 10px;">
                             <p style="display:inline;"><strong>'.ucwords(strtolower($rowfacname['fname'])).' '.ucwords(strtolower($rowfacname['lname'])).'</strong> '.$row['notif_description'].'<strong><br> '.ucwords(strtolower($row['subj_description'])).'</strong></p>
                             <p style="font-size:12px;">'.$row['date'].'</p>
                             
                          </div>
                        
                        </a>';
            }

                    

          echo $output;

   }

   if(isset($_POST['loadglobe'])){

      $description = "Submitted a grade on";
      $sql1 = "UPDATE notification SET status = 'read' WHERE notif_description ='$description'";
      $results = mysqli_query($con,$sql1);


             $sql ="SELECT * FROM notification WHERE notif_description='$description'
 AND status ='unread' ORDER BY `date` DESC";
                $result = mysqli_query($con, $sql);
                $count = mysqli_num_rows($result);

            if($count == 0){
               $output = '<a href="#" id="notificationLink onclick="loadglobe()"><i class="fa fa-bell" style="color:white;"></i>
                <span id="notification_count" style="padding:0 !important;"></span></a>';
            }
            else{
                 $output = '<a href="#" id="notificationLink" onclick="loadglobe()"><i class="fa fa-bell" style="color:white;"></i>
                <span id="notification_count">'.$count.'</span></a>';
            }

                echo $output;

   }

     if(isset($_POST['loadglobes'])){

      $description = "Submitted a grade on";

             $sql ="SELECT * FROM notification WHERE notif_description='$description'
 AND status='unread' ORDER BY `date` DESC";
                $result = mysqli_query($con, $sql);
                $count = mysqli_num_rows($result);

            if($count == 0){
               $output = '<a href="#" id="notificationLink onclick="loadglobe()"><i class="fa fa-bell" style="color:white;"></i>
                <span id="notification_count" style="padding:0 !important;"></span></a>';
            }
            else{
                 $output = '<a href="#" id="notificationLink" onclick="loadglobe()"><i class="fa fa-bell" style="color:white;"></i>
                <span id="notification_count">'.$count.'</span></a>';
            }


                echo $output;
    

   }

   if(isset($_POST['loadsubject']))
   {
      $college = $_POST['college'];
      $output ='';

        switch ($college) {
                case "information":
                    $college = "College of Information and Computing Science";
                    break;
                case "health":
                    $college = "College of Health";
                    break;
                case "commerce":
                    $college = "College of Commerce";
                    break;
                case "education":
                    $college = "College of Education";
                    break;
                case "crim":
                    $college = "College of Criminolgy";
                    break;
                case "engr":
                    $college = "College of Engineering";
                    break;
            }


             $sql ="SELECT * FROM subject WHERE college='$college'";
              $result = mysqli_query($con, $sql);

              while($row = mysqli_fetch_array($result))
              {
                $output .= '<option value='.$row['code'].'>'.$row['code'].' ('.$row['title'].')</option>';
              }

      echo $output;

   }

?>