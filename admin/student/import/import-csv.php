<?php
/*
 * @author Shahrukh Khan
 * @website http://www.thesoftwareguy.in
 * @facebbok https://www.facebook.com/Thesoftwareguy7
 * @twitter https://twitter.com/thesoftwareguy7
 * @googleplus https://plus.google.com/+thesoftwareguyIn
 */
 

require_once("configure.php");

if ($_REQUEST["mode"] == "import") {
    $row = 0;
    if (($handle = fopen("testing-exports.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($row > 0) {
                try {
					
					//$sql = "INSERT INTO tbl_users (user_id, first_name, last_name, gender, dob, address, email, phone, department, category)
//VALUES ('$student_id', '$fname', '$lname', '$gender', '$dob', '$address', '$email', '$phone', '$department', '$category')";

$sql = "INSERT INTO tbl_users (user_id, first_name, last_name, gender, dob, address, email, phone, department, category)
 values ( :student_id, :fname, :lname, :gender, :dob, :address, :email, :phone, :department, :category ) ";
                   	
                    //$sql = "INSERT INTO tbl_products2 (products_name, products_quantity,products_model,products_price,products_weight,products_status) values ( :pname, :qty, :model, :price, :weight, :status  ) ";
                    $stmt = $DB->prepare($sql);
                    $stmt->bindValue(":student_id",  $data[0]);
                    $stmt->bindValue(":fname",  $data[1]);
                    $stmt->bindValue(":lname",  $data[2]);
                    $stmt->bindValue(":gender",  $data[3]);
                    $stmt->bindValue(":dob",  $data[4]);
                    $stmt->bindValue(":address",  $data[5]);
                    $stmt->bindValue(":email",  $data[6]);
					$stmt->bindValue(":phone",  $data[7]);
					$stmt->bindValue(":department",  $data[8]);
					$stmt->bindValue(":category",  $data[9]);
                    
					$stmt->execute();
                    
                } catch (Exception $ex) {
                    printErrorMessage($ex->getMessage());
                }
            }
            $row++;
        }
        
        fclose($handle);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="http://theosftwareguy.in/favicon.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Import and Export CSV with PHP And MySql - thesoftwareguy</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>

    <body>

        <div id="container">
            <div id="body">
                <div class="mainTitle" >Import local CSV file with PHP And MySql</div>
                <div style="text-align:center;">
                    <a href="import-csv.php" title="Import CSV" ><img src="buttons/button_import.png" alt="Import CSV" width="151" height="38"> </a>   
                    <a href="export-csv.php" title="Export CSV" ><img src="buttons/button_export.png" alt="Export CSV" width="148" height="38"> </a>    
                 <a href="../index.php" title="HOME" ><img src="buttons/Splash_Screen.jpg" alt="HOME" width="148" height="38"> </a>    
   
				</div>
                <div class="height10"></div>
                <div class="height10"></div>
                <div style="text-align:center;">
                    <a href="import-csv.php?mode=import" title="Import The file" ><img src="buttons/button_import_file.png" alt="Import the local CSV file" width="208" height="38"></a> 
                    <a href="import-csv-using-file.php" title="Upload CSV" ><img src="buttons/button_upload_csv_file.png" alt="Import the local CSV file" width="153" height="38"></a> 
                </div>
                <article>
                    <table class="bordered" >
                        <thead>
                            <tr> 

                                <th style="font-weight:bold;text-align:left;">ID</th>
                                <th style="font-weight:bold;text-align:left;">student_id</th>
                                <th style="width:10%;text-align:center;font-weight:bold;">fname</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">lname</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">gender</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">dob</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">address</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">email</th>
								  <th style="width:15%;text-align:center;font-weight:bold;">Password</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">phone</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">department</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">category</th>
                            </tr>
                            </tr>
                            <?php
                           // $sql = "SELECT * FROM tbl_products2 WHERE 1";
							
                            $sql = "SELECT * FROM tbl_users ORDER BY tbl_users.first_name ASC";
 
                            try {
                                $stmt = $DB->prepare($sql);
                                $stmt->execute();
                                $results = $stmt->fetchAll();
                            } catch (Exception $ex) {
                                printErrorMessage($ex->getMessage());
                            }

                            // display all Records
                            foreach ($results as $rs) {
                                ?>
                                <tr>
                                    <td><?php echo stripslashes($rs["id"]) ?></td>
                                    <td style="text-align:center"><?php echo stripslashes($rs["user_id"]) ?></td>
                                    <td style="text-align:center;"><?php echo stripslashes($rs["first_name"]) ?></td>
                                    <td style="text-align:center;"><?php echo stripslashes($rs["last_name"]) ?></td>
                                    <td style="text-align:center;"><?php echo stripslashes($rs["gender"]) ?></td>
					                <td style="text-align:center"><?php echo stripslashes($rs["dob"]) ?></td>
                                    <td style="text-align:center"><?php echo stripslashes($rs["address"]) ?></td>
                                    <td style="text-align:center;"><?php echo stripslashes($rs["email"]) ?></td>
									<!-- decrypting password
									//$pass = md5($filesop[4])				 -->
									<td style="text-align:center;"><?php echo stripslashes($rs ["login"]) ?></td>
								    <td style="text-align:center;"><?php echo stripslashes($rs["phone"]) ?></td>
                                    <td style="text-align:center;"><?php echo stripslashes($rs["department"]) ?></td>
								     <td style="text-align:center;"><?php echo stripslashes($rs["category"]) ?></td>
                                </tr>
    <?php
}
if ($_REQUEST["mode"] != "import") {
    echo '<tr><td align="center" colspan="6">No Records to display. Please import the file to display the records.</td> </tr>';
}

if ($_REQUEST["mode"] == "import") {
    //@mysql_query("TRUNCATE TABLE `tbl_users`");
	
    @mysql_query("TRUNCATE TABLE `tbl_users`");
	
}
?>
                        </thead>
                    </table>   
           </article>
	</div>
</div>
</body>
</html>