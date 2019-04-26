<!-- ========= EDIT SCHOOLYEAR =========== -->
<?php
	if(isset($_POST['btn_save']))
	{
	    $txt_id = $_POST['hidden_id'];
	    $txt_edit_sy = $_POST['txt_edit_sy'];
	    $txt_edit_class = $_POST['txt_edit_class'];
	    $txt_edit_subj = $_POST['txt_edit_subj'];
	    $txt_edit_stud = $_POST['txt_edit_stud'];
	    $txt_edit_1stgrading = $_POST['txt_edit_1stgrading'];
	    $txt_edit_2ndgrading = $_POST['txt_edit_2ndgrading'];
	    $txt_edit_3rdgrading = $_POST['txt_edit_3rdgrading'];
	    $txt_edit_4thgrading = $_POST['txt_edit_4thgrading'];
		$txt_edit_5rdgrading = $_POST['txt_edit_5thdgrading'];
	    $txt_edit_6thgrading = $_POST['txt_edit_6thgrading'];
		 $txt_edit_7thgrading = $_POST['txt_edit_7thgrading'];
		$txt_edit_8rdgrading = $_POST['txt_edit_8thdgrading'];
	    $txt_edit_9thgrading = $_POST['txt_edit_9thgrading'];
		$txt_edit_10thgrading = $_POST['txt_edit_10thgrading'];
		$txt_edit_11thgrading = $_POST['txt_edit_11thgrading'];
 
	    $query = mysqli_query($con,"UPDATE tblstudentgrade SET 1stgrading = '".$txt_edit_1stgrading."',2ndgrading = '".$txt_edit_2ndgrading."',3rdgrading = '".$txt_edit_3rdgrading."',4thgrading = '".$txt_edit_4thgrading."',5thgrading = '".$txt_edit_5thgrading."',6thgrading = '".$txt_edit_6thgrading."',7thgrading = '".$txt_edit_7thgrading."',8thgrading = '".$txt_edit_8thgrading."',9thgrading = '".$txt_edit_9thgrading."',10thgrading = '".$txt_edit_10thgrading."' ,11thgrading = '".$txt_edit_11thgrading."' where id = '".$txt_id."' ");
	    $q = mysqli_query($con,"SELECT * from tblstudentgrade where id = '".$txt_id."' ");
	    while($row=mysqli_fetch_array($q)){
	    	if($row['2ndgrading'] != 0 && $row['3rdgrading'] != 0 && $row['4thgrading'] != 0 && $row['5thgrading'] != 0&& $row['6thgrading'] != 0&& $row['7thgrading'] != 0&& $row['8thgrading'] != 0&& $row['9thgrading'] != 0&& $row['10thgrading'] != 0){
	    		$result = (( $row['1stgrading'] + $row['2ndgrading'] + $row['3rdgrading'] + $row['4thgrading']+ $row['4thgrading']+ $row['5thgrading']+ $row['6thgrading']+ $row['7thgrading']+ $row['8thgrading']+ $row['8thgrading']+ $row['10thgrading'] ) / 10) ;
	    		$average = round($result);
	    		if($average >=80 ){
					//$query = mysqli_query($con,"UPDATE tblstudentgrade SET gradeaverage = '".$average."', remarks = 'Passed'  where id = '".$txt_id."' ");
		    	$query = mysqli_query($con,"UPDATE tblstudentgrade SET gradeaverage = '".$Grade."', Grade = 'A'  where id = '".$txt_id."' ");
		    	
				}
				else if($average >=70 ){
					//$query = mysqli_query($con,"UPDATE tblstudentgrade SET gradeaverage = '".$average."', remarks = 'Passed'  where id = '".$txt_id."' ");
		    	$query = mysqli_query($con,"UPDATE tblstudentgrade SET gradeaverage = '".$Grade."', Grade = 'B'  where id = '".$txt_id."' ");
		    	
				}
				if($average >=60 ){
					//$query = mysqli_query($con,"UPDATE tblstudentgrade SET gradeaverage = '".$average."', remarks = 'Passed'  where id = '".$txt_id."' ");
		    	$query = mysqli_query($con,"UPDATE tblstudentgrade SET gradeaverage = '".$Grade."', Grade = 'C'  where id = '".$txt_id."' ");
		    	
				}
				if($average >=50 ){
					//$query = mysqli_query($con,"UPDATE tblstudentgrade SET gradeaverage = '".$average."', remarks = 'Passed'  where id = '".$txt_id."' ");
		    	$query = mysqli_query($con,"UPDATE tblstudentgrade SET gradeaverage = '".$Grade."', Grade = 'D'  where id = '".$txt_id."' ");
		    	
				}
				if($average >=40 ){
					//$query = mysqli_query($con,"UPDATE tblstudentgrade SET gradeaverage = '".$average."', remarks = 'Passed'  where id = '".$txt_id."' ");
		    	$query = mysqli_query($con,"UPDATE tblstudentgrade SET gradeaverage = '".$Grade."', Grade = 'E'  where id = '".$txt_id."' ");
		    	
				}
				
	    		else{
					$query = mysqli_query($con,"UPDATE tblstudentgrade SET gradeaverage = '".$average."', remarks = 'Failed'  where id = '".$txt_id."' ");    	
	    		$query = mysqli_query($con,"UPDATE tblstudentgrade SET gradeaverage = '".$Grade."', Grade = 'E'  where id = '".$txt_id."' ");
		    	
				}
	    	}
	    	else{
	    		$result = (( $row['1stgrading'] + $row['2ndgrading'] + $row['3rdgrading'] + $row['4thgrading']+ $row['5thgrading']+ $row['6thgrading']+ $row['7thgrading']+ $row['8thgrading']+ $row['9thgrading'] + $row['10thgrading']) / 10) ;
	    		$average = round($result);
	    		$query = mysqli_query($con,"UPDATE tblstudentgrade SET gradeaverage = '".$average."', remarks = 'No Final Remarks'  where id = '".$txt_id."' ");    	
	    	}
	    }


	    if($query == true){
	        $_SESSION['edit'] = 1;
	        header("location: ".$_SERVER['REQUEST_URI']);
	    }

		if(mysqli_error($con)){
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
	}
?>
