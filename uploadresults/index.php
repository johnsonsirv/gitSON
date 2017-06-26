<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Upload result</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3>Upload Result for New Intakes</h3>
					<div class="panel-content">
					
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" role="form" autocomplete="off" enctype="multipart/form-data">
							<legend>Upload Result for New Intakes</legend>
								<?php 

										if(isset($_POST['upload'])){
   // require"connect2.php";
    
											    if(empty($_POST['resultyear'])){
											        $error="Choose Result Year";
											        $html='<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Error, '.$error.'</strong></div>';
											        echo ($html);
											    
											    } else if(empty($_FILES['result']['name'])){
											         $error="Choose Result to Upload";
											        $html='<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Error, '.$error.'</strong></div>';
											        echo ($html);
											    
											    } 
											 else{ ///run upload of files
											 		
											 		 $year = stripslashes(strtoupper(str_replace(' ','',$_POST['resultyear'])));
											 	 	 $uploadname = $_FILES['result']['name'];
       												 $tmp_name = $_FILES['result']['tmp_name'];
      												 $uploadtype = $_FILES['result']['type'];
        											 //$extension = strtolower(substr($uploadname,strpos($uploadname,'.')+1));
        												$extension= explode('.', $_FILES['result']['name']);

												        if(strtolower(end($extension)) != "csv"){
												                  $error="File Must be an Excel Document Saved With .CSV Extension";
												                 $html='<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Error, '.$error.'</strong></div>';
												        echo ($html);
												        
												        }else if(strlen($year) != 4){
												            //echo "<span style='color:red; font-weight:bold;'>Enter the Result Year In Four Digits eg. 2008</span>";
												             $error="Enter the Result Year In Four Digits eg. 2017";
												            $html='<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Error, '.$error.'</strong></div>';
												            echo ($html);
												        }
												        else{
												        	//read the csv file
												        	$row = 0; $num = 0;
												        	if ($handle = fopen($tmp_name, 'r')) {
												        		$table ='<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												        		<table class="table table-hover table-bordered">
												        					<tr class="alert-info text-center">
												        					<td colspan="7"><i class="glyphicon glyphicon-check"></i> <b>Result Preview<b> </td></tr>
												        					<tr>
												        					<td>Exam No</td><td>Candidate Name</td><td>SIT</td>
												        					<td>ENG</td><td>QRT</td><td>TOTAL</td>
												        					<td>AVE</td>
												        					</tr>

												        					<tr>
												        						';
												        		while (($data=fgetcsv($handle,1000,','))!==false) {
												        			$num=count($data);
												        			//skip the first row with the headers												        			
												        			if($row>0){
												        				for ($i=0; $i<$num; $i++) { 
												        				
												        					$table= $table . '<td>'. $data[$i].' </td>' ;
												        				
												        				}
												        			}
												       
																		$table= $table . '</tr>';
																		$row++;
												        		}

												        		fclose($handle);
												        				//$table= $table . '</tbody></table>';
												        				
																		echo $table. '</table></div>';
												        		
												        		$error="Result Uploaded.<br> Result Year:". $year." <br>File Name:". $uploadname. " <br>Total number of records found:". $row ;
												                 $html='<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Sucess, '.$error.'</strong></div>';
												                 echo ($html);
												        	}

												        	else{
                                           							
                                           					 $error=">Unable to Read File";
												           	 $html='<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Error, '.$error.'</strong></div>';
												           		 echo ($html);
                                    
                                      							  }


												        }///end read csv file


											 } //end run uploads
										} //end isset
									?>
							<div class="form-group">
								<label for="">Result Year</label>
								<input type="text" name="resultyear" class="form-control" id="" placeholder="Result Year" required>
							</div>
							<div class="form-group">
								<label for="">Upload Result (.csv extension)</label>
								<input type="file" name="result" placeholder="Browse" accept=".csv" style="width:100%;" required>
							</div>
						
							<button type="submit" name="upload" class="btn large btn-primary btn-block"><i class="icon-upload"></i> Upload Result</button>
						</form>
				</div>
					
				</div>
			</div>
		</div>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
	</body>
</html>