<?php
require_once("configure.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="http://www.thesoftwareguy.in/favicon.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Import and Export CSV with PHP And MySql - thesoftwareguy</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>

    <body>

        <div id="container">
            <div id="body">
                <div class="mainTitle" >Export CSV with PHP And MySql</div>
                <div style="text-align:center;">
                    <a href="import-csv.php" title="Import CSV" ><img src="buttons/button_import.png" alt="Import CSV" width="151" height="38"> </a>   
                    <a href="export-csv.php" title="Export CSV" ><img src="buttons/button_export.png" alt="Export CSV" width="148" height="38"> </a>    
 <a href="../index.php" title="HOME" ><img src="buttons/Splash_Screen.jpg" alt="HOME" width="148" height="38"> </a>    
                  
			   </div>
                <div class="height10"></div>
                <div class="height10"></div>
                <div style="text-align:center;">
                    <a href="export.php" title="Export The table" ><img src="buttons/button_export_table.png" alt="Export The table" width="229" height="38"></a> 
                </div>
                <article>
                    <table class="bordered" >
                        <thead>

                            <tr> 
							
							 <th style="font-weight:bold;text-align:left;">ID</th>
                                <th style="font-weight:bold;text-align:left;">student_id</th>
                                <th style="width:10%;text-align:center;font-weight:bold;">First name</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">Last name</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">Gender</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">dob</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">Address</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">Email</th>
								  <th style="width:15%;text-align:center;font-weight:bold;">Password</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">phone</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">Department</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">Category</th>
							
                                <th style="width:15%;text-align:center;font-weight:bold;">Status</th>
                            </tr>
                            <?php
                           // $sql = "SELECT * FROM tbl_products1 WHERE 1";
							$sql = "SELECT * FROM tbl_users ORDER BY tbl_users.first_name ASC";
                            try {
                                $stmt = $DB->prepare($sql);
                                $stmt->execute();
                                $results = $stmt->fetchAll();
                            } catch (Exception $ex) {
                                printErrorMessage($ex->getMessage());
                            }
                            // display all products
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
									
									<!-- decrypting password     $pass = md5($filesop[4])	-->			
									<td style="text-align:center;"><?php echo stripslashes($rs ["login"]) ?></td>
								    <td style="text-align:center;"><?php echo stripslashes($rs["phone"]) ?></td>
                                    <td style="text-align:center;"><?php echo stripslashes($rs["department"]) ?></td>
								     <td style="text-align:center;"><?php echo stripslashes($rs["category"]) ?></td>
                                
                                    <td style="text-align:center;"><?php echo ($rs["acc_stat"] == "1") ? "Active" : "Inactive"; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </thead>
                    </table>
                    <div class="height10"></div>
                </article>
                <div style="margin:10px 0;width:100%;float: left;">
	
	<div style="width:35%;float: left;margin:0 auto;text-align: center;">
		<!-- Place this tag where you want the widget to render. -->
		<div class="g-person" data-href="https://plus.google.com/116523474604785207782"  data-rel="author" data-layout="potrait"></div>

		<!-- Place this tag after the last widget tag. -->
		<script type="text/javascript">
			(function() {
				var po = document.createElement('script');
				po.type = 'text/javascript';
				po.async = true;
				po.src = 'https://apis.google.com/js/platform.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(po, s);
			})();
		</script>
	</div>
	<div style="width:30%;float: left;margin:0 auto;text-align: center;">
		<a class="twitter-follow-button"
		href="https://twitter.com/johnsonedem"
		data-show-count="true" 
		data-lang="en" data-size="large" >
		Follow @johnsonedem
		</a>
		<script type="text/javascript">
		window.twttr = (function (d, s, id) {
		var t, js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src= "https://platform.twitter.com/widgets.js";
		fjs.parentNode.insertBefore(js, fjs);
		return window.twttr || (t = { _e: [], ready: function (f) { t._e.push(f) } });
		}(document, "script", "twitter-wjs"));
		</script>
	</div>
</div>
<div class="height10"></div>
                <footer>
                    <div class="copyright">
                        &copy; 2018 <a href="http://www.thesoftwareguy.in" target="_blank">thesoftwareguy</a>. All rights reserved
                    </div>
                    <div class="footerlogo"><a href="http://www.thesoftwareguy.in" target="_blank"><img src="http://www.thesoftwareguy.in/thesoftwareguy-logo-small.png	" width="200" height="47" alt="thesoftwareguy logo" /></a> </div>
                </footer>
            </div></div>

    </body>
</html>