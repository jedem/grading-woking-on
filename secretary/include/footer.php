</div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/myscript.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>



<script>
        $(document).ready(function()
        {
              getsubjects();
              loadnotif();
               setInterval(loadnotifs, 1000);

              $("#notificationsss").on("click",$("#notificationLink"), function() {
                $("#notificationContainer").fadeToggle(300);
              $("#notification_count").fadeOut("slow");

              });
        });

function getsubjects(){
        $.ajax({
        url:'notification.php',
        method:'POST',
        data:{
          "loadallsubjects": 1
        },
        success:function(data){
          $("#tablesub").empty();
          $('#tablesub').html(data);
        }
      });
}
      

    $("#search").click(function() {
       var search = $("#searchval").val();

        $.ajax({
        url:'notification.php',
        method:'POST',
        data:{
          "loadsearchtext": 1,
          "search":search
        },
        success:function(data){
          $("#tablesub").empty();
          $('#tablesub').html(data);
        }
      });

    });

      $("#searchcurriculum").click(function() {
       var college = $("#collegess").val();
       var course = $("#coursess").val();
       var curriculum = $("#curriculum").val();

       if(college == ''){
          alert('Please select a college');
       }else if(course == ''){
          alert('Please select a course');
       }else if(curriculum == ''){
          alert('Please select a curriculum');
       }
       else{
            $.ajax({
            url:'notification.php',
            method:'POST',
            data:{
              "loadsearchcurriculum": 1,
              "college":college,
              "course":course,
              "curriculum":curriculum
            },
            success:function(data){
              $("#tablesub").empty();
              $('#tablesub').html(data);
            }
          });
       }

    });

    $(".college").change(function(){

     var college = this.value;

        if(college == 'information'){
          $(".course").empty();
          $(".course").append('<option value=cs>Bachelor of Science in Computer Science</option>');
          $(".course").append('<option value=it>Bachelor of Science in Information Technology</option>');
          $(".course").append('<option value=ce>Bachelor of Science in Computer Engineering</option>');
        }else if(college == 'health'){
          $(".course").empty();
          $(".course").append('<option value=nurse>Bachelor of Science in Nursing</option>');
          $(".course").append('<option value=midwife>Bachelor of Science in Midwife</option>');
          $(".course").append('<option value=midwirey>Diploma in Midwirey</option>');
        }else if(college == 'commerce'){
          $(".course").empty();
          $(".course").append('<option value=account>Bachelor of Science in Accountancy</option>');
          $(".course").append('<option value=ba>Bachelor of Science in Business Administration</option>');
          $(".course").append('<option value=hrm>Bachelor of Science in HRM</option>');
        }else if(college =='education'){
          $(".course").empty();
          $(".course").append('<option value=se>Bachelor of Science in Secondary Education</option>');
          $(".course").append('<option value=educ>Bachelor of Elementary Education</option>');
        }else if(college =='crim'){
          $(".course").empty();
          $(".course").append('<option value=crim>Bachelor of Science in Criminology</option>');      
        }else if(college =='engr'){
          $(".course").empty();
          $(".course").append('<option value=cpe>Bachelor of Science in Civil Engineering</option>');
          $(".course").append('<option value=ge>Bachelor of Science in Geodetic Engineering</option>');
        }

                $.ajax({
                url:'notification.php',
                method:'POST',
                data:{
                  "loadsubject": 1,
                  "college":college
                },
                success:function(data){
                   $(".subject").empty();
               $(".subject").append(data);
                }
              });



    });

function getto(year){
    var to = parseInt(year.value,10) + 1;
    document.getElementById('to').value= to;
}

$("#colleges").change(function() {
    var college = this.value;

    if(college == 'information'){
      $("#courses").empty();
      $("#courses").append('<option value=cs>Bachelor of Science in Computer Science</option>');
      $("#courses").append('<option value=it>Bachelor of Science in Information Technology</option>');
      $("#courses").append('<option value=ce>Bachelor of Science in Computer Engineering</option>');
    }else if(college == 'health'){
      $("#courses").empty();
      $("#courses").append('<option value=nurse>Bachelor of Science in Nursing</option>');
      $("#courses").append('<option value=midwife>Bachelor of Science in Midwife</option>');
      $("#courses").append('<option value=midwirey>Diploma in Midwirey</option>');
    }else if(college == 'commerce'){
      $("#courses").empty();
      $("#courses").append('<option value=account>Bachelor of Science in Accountancy</option>');
      $("#courses").append('<option value=ba>Bachelor of Science in Business Administration</option>');
      $("#courses").append('<option value=hrm>Bachelor of Science in HRM</option>');
    }else if(college =='education'){
      $("#courses").empty();
      $("#courses").append('<option value=se>Bachelor of Science in Secondary Education</option>');
      $("#courses").append('<option value=educ>Bachelor of Elementary Education</option>');
    }else if(college =='crim'){
      $("#courses").empty();
      $("#courses").append('<option value=crim>Bachelor of Science in Criminology</option>');      
    }else if(college =='engr'){
      $("#courses").empty();
      $("#courses").append('<option value=cpe>Bachelor of Science in Civil Engineering</option>');
      $("#courses").append('<option value=ge>Bachelor of Science in Geodetic Engineering</option>');
    }

});

$("#collegess").change(function() {
    var college = this.value;

    if(college == 'information'){
      $("#coursess").empty();
      $("#coursess").append('<option value=cs>Bachelor of Science in Computer Science</option>');
      $("#coursess").append('<option value=it>Bachelor of Science in Information Technology</option>');
      $("#coursess").append('<option value=ce>Bachelor of Science in Computer Engineering</option>');
    }else if(college == 'health'){
      $("#coursess").empty();
      $("#coursess").append('<option value=nurse>Bachelor of Science in Nursing</option>');
      $("#coursess").append('<option value=midwife>Bachelor of Science in Midwife</option>');
      $("#coursess").append('<option value=midwirey>Diploma in Midwirey</option>');
    }else if(college == 'commerce'){
      $("#coursess").empty();
      $("#coursess").append('<option value=account>Bachelor of Science in Accountancy</option>');
      $("#coursess").append('<option value=ba>Bachelor of Science in Business Administration</option>');
      $("#coursess").append('<option value=hrm>Bachelor of Science in HRM</option>');
    }else if(college =='education'){
      $("#coursess").empty();
      $("#coursess").append('<option value=se>Bachelor of Science in Secondary Education</option>');
      $("#coursess").append('<option value=educ>Bachelor of Elementary Education</option>');
    }else if(college =='crim'){
      $("#coursess").empty();
      $("#coursess").append('<option value=crim>Bachelor of Science in Criminology</option>');      
    }else if(college =='engr'){
      $("#coursess").empty();
      $("#coursess").append('<option value=cpe>Bachelor of Science in Civil Engineering</option>');
      $("#coursess").append('<option value=ge>Bachelor of Science in Geodetic Engineering</option>');
    }

});



 function loadnotif(){
              $.ajax({
                url:'notification.php',
                method:'POST',
                data:{
                  "loadnotif": 1
                },
                success:function(data){
                  $('#notificationsss').html(data);

                }
              });
            }

   function loadnotifs(){
              $.ajax({
                url:'notification.php',
                method:'POST',
                data:{
                  "loadnotifs": 1
                },
                success:function(data){
                    $('#notificationsBody').empty();

                  $('#notificationsBody').append(data);
                  loadglobes();
                }
              });
            }

      function loadglobe(){
               $.ajax({
                url:'notification.php',
                method:'POST',
                data:{
                  "loadglobe": 1
                },
                success:function(data){
                   
               $('#notificationLink').empty();
                 $('#notificationLink').append(data);

                            
                }
              });
            }

   function loadglobes(){
               $.ajax({
                url:'notification.php',
                method:'POST',
                data:{
                  "loadglobes": 1
                },
                success:function(data){
              
               $('#notificationLink').empty();
                 $('#notificationLink').append(data);

                            
                }
              });
            }
</script>
</body>

</html>